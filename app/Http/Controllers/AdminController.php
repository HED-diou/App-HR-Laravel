<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Candidat;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\IsStrongPassword;
use App\Rules\IsValidBirthDate;
use Mail;
use App\Models\Hobies;
use App\Models\Villes;
use App\Models\Appreciation;
use App\Models\HobieCandidat;
use App\Models\TechnologieCandidat;
use App\Models\Technologies;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $user_id=Auth::user()->id;
        $sql=" SELECT sum(balance) as sum FROM users";
        $total = DB::select(DB::raw($sql));
        $sql3="SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE (SELECT DATE(now()) from DUAL) BETWEEN rh.start_date AND rh.end_date AND rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) AND rh.statut = 2 ORDER BY rh.updated_at DESC, r.user_id";
        $empcongs=DB::select(DB::raw($sql3));
        $countempcong=count($empcongs);
        $request_history =DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id ORDER BY rh.updated_at DESC, rh.request_id');
        $requests = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) ORDER BY  rh.updated_at DESC, r.user_id  LIMIT 5');
        $countreq=count($requests);
        $bankdays=DB::table('bank_holiday')->get();
        $types = DB::table('holiday_type')->get();
        $sql4="SELECT * from bank_holiday where start_date>= now() limit 1";
        $proche_bankday=DB::select(DB::raw($sql4));
        return view('admin.index',compact( 'bankdays','user_id','requests','countreq','types',"total","empcongs","countempcong","request_history", "proche_bankday"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::All();
        $managers = DB::select('SELECT * FROM users');
        return view('admin.create', compact('companies', 'managers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Auth::user()->id;

        $birthdate = Carbon::now();
        $birthdate->subYears(18);
        $hiredate = Carbon::create(2015, 4, 20, 0);
        $now = Carbon::now();

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required |email| unique:users',
            'balance' => 'required|numeric|min:0.5|max:40',
            'hiredate' => 'required',
            'company_id' => 'required',
            'password' => ['required', 'string', 'confirmed', new IsStrongPassword()],
            'password_confirmation' => 'required',
            'birthdate' => [new IsValidBirthDate()],
            'tel' => 'required|digits:10|numeric',
        ]);

        $user = User::create($request->all());
        $token=mt_rand(100000, 999999);
        $start=new \DateTime();
        $sql="UPDATE users set token=".$token.", Token_startD=NOW(),Token_endD=DATE_ADD(NOW() , INTERVAL 5 MINUTE) where id=".$user->id;
        $tokens=DB::select(DB::raw($sql));
        if(!$user->hasRole('admin') && $user['admin'] == 1)
        {
            $adminRole = Role::where('name', 'admin')->firstOrFail();
            $user->roles()->attach($adminRole->id);
        }

        elseif($user->hasRole('admin') && $user['admin'] == 0)
        {
            $adminRole = Role::where('name', 'admin')->firstOrFail();
            $user->roles()->detach($adminRole->id);
        }

        $users = User::All();
        $to_name = $user->firstname ." ".$user->lastname;
        $to_email = $user->email;
        $data = array('name'=>$user->firstname ." ".$user->lastname, "body" => ' An account has been created for you on the Wave HR platform, please activate it by clicking on the following link : '.url("/user/change-password/{$user->id}/{$token}").' The link will expire in five minutes. ');
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Creation of a new account.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });

        $sql="SELECT * from users where admin= 1";
        $admins = DB::select(DB::raw($sql));
        for($i=0;$i<count($admins);$i++)
        {
            $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
            $email=$admins[$i]->email;
           $data = array('name'=>$name, "body" => ' An account has been created for '.$to_name.' on the Wave HR platform.');
            Mail::send('emails', $data, function($message) use ($name,$email ) {
                $message->to($email, $name)->subject('Wave HR> Creation of a new Wave HR account.');
                $message->from(config('mail.from.address'),'Wave HR Team');
            });
        }
        return redirect()->route('admin.users',compact($users,"id"))
                        ->with('success','User created successfully.');
    }
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function users()
    {   $id=Auth::user()->id;
      //  $data = DB::select('SELECT u.id, u.firstname, u.lastname, u.email, u.password, u.hiredate, u.balance, u.tel, u.address, u.birthdate, u.cin, u.cnss, u.manager, u.admin, u.statut, name as companyName, m.firstname as managerFirstName, m.lastname as managerLastName FROM users as u LEFT JOIN companies as c ON  u.company=c.id LEFT JOIN users as m ON u.manager=m.id ORDER BY u.id');
        $var=User::query()->paginate(7);
        $data2 = DB::select('SELECT * FROM companies');
        return view('admin.users',['users' => $var, 'companies' => $data2,'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $companies = DB::select('SELECT * FROM companies');
        $managers = DB::select('SELECT * FROM users');
        return view('admin.edit', compact('user', 'companies', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required',
            'email' => 'required |email',
            'password' => 'nullable|confirmed|min:6',
            'cin' => '',
            'tel' => 'required|digits:10|numeric',
            'company' => 'required',
            'hiredate' => 'required',
        ]);

        if($request['password'] != "")
        {
            $user->connected_at = NULL;
        }

        $user->update($request->except(['balance']));




        if(!$user->hasRole('admin') && $user['admin'] == "1")
        {
            $adminRole = Role::where('name', 'admin')->firstOrFail();
            $user->roles()->attach($adminRole->id);

        }

        elseif($user->hasRole('admin') && $user['admin'] == "0")
        {

            $adminRole = Role::where('name', 'admin')->firstOrFail();
            $user->roles()->detach();

        }
        $id=Auth::user()->id;


        return redirect()->route('admin.users','id')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable(User $user)
    {

        $users = DB::select('SELECT u.id, u.firstname, u.lastname, u.email, u.password, u.hiredate, u.balance, u.tel, u.address, u.birthdate, u.cin, u.cnss, u.manager, u.admin, u.statut, name as companyName, m.firstname as managerFirstName, m.lastname as managerLastName FROM users as u LEFT JOIN companies as c ON  u.company_id=c.id LEFT JOIN users as m ON u.manager=m.id ORDER BY u.id');
        $companies = DB::select('SELECT * FROM companies');

        $user->statut = 0;
        $user->save();
        $id=Auth::user()->id;

        return redirect()->route('admin.users',compact($users, $companies,$id))
                        ->with('success','User disabled successfully.');



    }
    public function enable(User $user)
    {
        $users = DB::select('SELECT u.id, u.firstname, u.lastname, u.email, u.password, u.hiredate, u.balance, u.tel, u.address, u.birthdate, u.cin, u.cnss, u.manager, u.admin, u.statut, name as companyName, m.firstname as managerFirstName, m.lastname as managerLastName FROM users as u LEFT JOIN companies as c ON  u.company_id=c.id LEFT JOIN users as m ON u.manager=m.id ORDER BY u.id');
        $companies = DB::select('SELECT * FROM companies');

        $user->statut = 1;
        $user->save();
        $id=Auth::user()->id;

        return redirect()->route('admin.users',compact($users, $companies,$id))
                        ->with('success','User enabled successfully.');

    }
    public function reset_password(User $user)
    {


        $id=Auth::user()->id;

        $users = DB::select('SELECT u.id, u.firstname, u.lastname, u.email, u.password, u.hiredate, u.balance, u.tel, u.address, u.birthdate, u.cin, u.cnss, u.manager, u.admin, u.statut, name as companyName, m.firstname as managerFirstName, m.lastname as managerLastName FROM users as u LEFT JOIN companies as c ON  u.company_id=c.id LEFT JOIN users as m ON u.manager=m.id ORDER BY u.id');
        $companies = DB::select('SELECT * FROM companies');
        $user->connected_at = NULL;
        $user->save();
        $token=mt_rand(100000, 999999);
        $start=new \DateTime();
        $sql1="UPDATE users set reset_token=".$token.", reset_token_startd=NOW(),reset_token_endd=DATE_ADD(NOW() , INTERVAL 5 MINUTE) where id=".$user->id;
        $tokens=DB::select(DB::raw($sql1));
        $to_name = $user->firstname ." ".$user->lastname;
        $to_email = $user->email;
        $data = array('name'=>$user->firstname ." ".$user->lastname, "body" => 'You requested to reset your account password at Wave HR  Here is the link to change your password : '.url("/user/reset-password/{$user->id}/{$token}").' The link will expire in five minutes. ');
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Reset password.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });


        Auth::loginUsingId($user);
        return redirect()->route('admin.users',compact($users, $companies,$id))
                        ->with('success','Password reseted successfully.');
    }
    public function candidat()
    {  $id=Auth::user()->id;
         // $data1 = DB::select('SELECT * FROM candidats');
          //$searchTerm = '%'.$this->searchTerm.'%';
          $var=Candidat::query()->paginate(7);
          $data2 = DB::select('SELECT * FROM hobies');
          $data3 = DB::select('SELECT * FROM hobie_candidats');
          $data4 = DB::select('SELECT * FROM technologies');
          $data5 = DB::select('SELECT * FROM technologie_candidats');
          $data6 = DB::select('SELECT * FROM appreciations');
          $data7 = DB::select('SELECT * FROM villes');
          $users = Candidat::all();
          //$users = Candidat::where('Nom');
          
          return view('admin.candidat',[
              'users' => $var, 
              'hobies' => $data2,
              'hobie_candidats' => $data3,
              'technologies' => $data4,
              'technologie_candidats' => $data5,
              'appreciations' => $data6,
              'Villes' => $data7,
              'id'=>$id
              ]);//compact('users','data1','var','data2','data3','id'));
    }
    public function candidat_create()
    {   $hobies = Hobies::all();
        $technologies = Technologies::all();
        $villes = Villes::all();
        $Appreciations = Appreciation::all();
        return view('admin.candidat_create',compact('hobies','villes','Appreciations','technologies'));
        
    }

    public function store_c(Request $request,Candidat $candidat)
    { //-------------------------------------------------- il me reste de gerer les multiselect
        
         //dd($request->CV->getClientOriginalName());
        
        // die();
        //var_dump($_POST[$request]);
        //die();
        
        //dd($extension);
        Candidat::create([
            'Nom'=> $request->Nom,
            'Prenom'=> $request->Prenom,
            'Sexe'=> $request->Sexe,
            'motife'=> $request->motife,
            'phone'=> $request->phone,
            'CIN'=> $request->CIN,
            'Adresse' => $request->Adresse,
            'email' => $request->email,
            'StatutFamiliale' =>$request->StatutFamiliale,
            'Ville' =>$request->Ville,
            'NombreDanneesDexperience' => $request->NombreDanneesDexperience,
            'PretentionSalariale' => $request->PretentionSalariale,
            'DateNaissance' => $request->DateNaissance,
            'EnArretDepuis' => $request->EnArretDepuis,
            'CV' => $request->CV->getClientOriginalName(),
            'LettreMotivation' => $request->LettreMotivation->getClientOriginalName(),
            'Appreciation' => $request->Appreciation,
        ]);


        $extension = $request->CV->extension();

        if($request->hasFile('CV'))
        {
            if($extension == 'png' || $extension == 'pdf'){
                $destination_path = 'public/cv/cv_files';
                $cv = $request->CV;
                $cv_name = $request->CV->getClientOriginalName();
                $path = $request->file('CV')->storeAs($destination_path,$cv_name);
            }
        }
        $extension = $request->CV->extension();
        if($request->hasFile('LettreMotivation'))
        {
            if($extension == 'png' || $extension == 'pdf'){
                $destination_path = 'public/cv/lt_files';
                $LettreMotivation = $request->LettreMotivation;
                $LettreMotivation_name = $request->LettreMotivation->getClientOriginalName();
                $path = $request->file('LettreMotivation')->storeAs($destination_path,$LettreMotivation_name);
            }
        }


        //$request->CV->store('cv_files');
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        //$c = Candidat::where('id')->get();
        $c = Candidat::select('id')->max('id');
        //dd($c);
        $data2 = $request->hobies;
        foreach($data2 as $d2)
        {
            //dump($d2);
            hobieCandidat::create([
                'Hobie_id' => $d2,
                'candidats_id' => $c,
            ]);
        }
        //die();
        $data = $request->technologies;
        //dd($data);
        foreach($data as $d)
        {
            TechnologieCandidat::create([
                'technologie_id' => $d,
                'candidats_id' => $c,
            ]);
        }
        
        //$Appreciation->id,
        $id=Auth::user()->id;
          $data = DB::select('SELECT * FROM candidats');
          $var=Candidat::query()->paginate(7);
          $data2 = DB::select('SELECT * FROM candidats');
          $Appreciations  = DB::select('SELECT * FROM Appreciations');
          $technologies = DB::select('SELECT * FROM technologies');
          $hobies = DB::select('SELECT * FROM hobies');
          $villes   = DB::select('SELECT * FROM villes');
          $users = Candidat::all();
          return view('admin.candidat',['users' => $var, 'companies' => $data2,'id'=>$id, 'appreciations' => $Appreciations, 'hobies'=> $hobies, 'technologies'=>$technologies, 'Villes'=>$villes ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_c(Candidat $candidat)
    {
        //dd($candidat->id);
        $user = Candidat::all();
        //$candidat = DB::select("SELECT * FROM candidats");
        $hobies = DB::select('SELECT * FROM hobies');
        $hobie_candidats = DB::select('SELECT * FROM hobie_candidats hc , hobies t where  hc.hobie_id = t.id and hc.candidats_id = '.$candidat->id.' ');
        $technologies = DB::select('SELECT * FROM technologies');
        $technologie_candidats = DB::select('SELECT * FROM technologie_candidats tc  , technologies t where  tc.technologie_id = t.id and tc.candidats_id = '.$candidat->id.' ');
        $Appreciations  = DB::select('SELECT * FROM Appreciations');
        $villes   = DB::select('SELECT * FROM villes');
        $tchno = DB::select('SELECT * FROM technologie_candidats');
        
        return view('admin.edit_candidat', compact('tchno','user','candidat', 'hobies', 'hobie_candidats', 'technologies', 'technologie_candidats','Appreciations','villes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_c(Request $request, Candidat $candidat)
    {
        
        
            $candidat->update([
                'Nom'=> $request->Nom,
                'Prenom'=> $request->Prenom,
                'Sexe'=> $request->Sexe,
                'motife'=> $request->motife,
                'phone'=> $request->phone,
                'CIN'=> $request->CIN,
                'Adresse' => $request->Adresse,
                'email' => $request->email,
                'StatutFamiliale' =>$request->StatutFamiliale,
                'Ville' =>$request->Ville,
                'NombreDanneesDexperience' => $request->NombreDanneesDexperience,
                'PretentionSalariale' => $request->PretentionSalariale,
                'DateNaissance' => $request->DateNaissance,
                'EnArretDepuis' => $request->EnArretDepuis,
                'CV' => $request->hasFile('CV') ? time() . $request->CV->getClientOriginalName() : $candidat->CV, // <---------------------------------------------- ??
                'LettreMotivation' => $request->hasFile('LettreMotivation') ? time() . $request->LettreMotivation->getClientOriginalName() : $request->LettreMotivation,
                'Appreciation' => $request->Appreciation,
            ]);
         
        
        // Groupe code des multi select 
        
        $data2 = $request->hobies;
        if($data2 != null)
        {
            $c = $candidat->id;
            $hb = DB::select('select * from hobie_candidats');
            foreach($hb as $hh){
                $hobie = DB::delete('delete from hobie_candidats where candidats_id = ?' , [$hh->candidats_id] );
            }
            foreach($data2 as $d2)
            {
                hobieCandidat::create([
                    'Hobie_id' => $d2,
                    'candidats_id' => $c,
                ]);
            }
        }
        
        

        $data = $request->technologies;
        if($data != null)
        {
            $c = $candidat->id;
            $hb = DB::select('select * from technologie_candidats');
            foreach($hb as $th){
                $hobie = DB::delete('delete from technologie_candidats where candidats_id = ?' , [$th->candidats_id] );
            }
            
            foreach($data2 as $d2)
            {
                TechnologieCandidat::create([
                    'technologie_id' => $d2,
                    'candidats_id' => $c,
                ]);
            }
        }
        //-----------------------------------------------

        

        if($request->hasFile('CV'))
        {
            $extension = $request->CV->extension();
            if($extension == 'png' || $extension == 'pdf'){
                $destination_path = 'public/cv/cv_files';
                $cv = $request->CV;
                $cv_name = time() . $request->CV->getClientOriginalName();
                $path = $request->file('CV')->storeAs($destination_path,$cv_name);
            }
        }
        
        if($request->hasFile('LettreMotivation'))
        {
            $extension = $request->LettreMotivation->extension();
            if($extension == 'png' || $extension == 'pdf'){
                $destination_path = 'public/cv/lt_files';
                $LettreMotivation = $request->LettreMotivation;
                $LettreMotivation_name = time() . $request->LettreMotivation->getClientOriginalName();
                $path = $request->file('LettreMotivation')->storeAs($destination_path,$LettreMotivation_name);
            }
        }



        //die();
        
        //dd($data);
        
    
        return redirect()->route('admin.candidat')
                        ->with('success','User updated successfully');
    }

    public function search(Request $request)
    {
        //dd($request->all());   
        $id=Auth::user()->id;
          //$data1 = DB::select('SELECT * FROM candidats');
          //$searchTerm = '%'.$this->searchTerm.'%';
          //$var=Candidat::query()->paginate(7);
          //$var = DB::select('SELECT * FROM candidats');
          //$var=Candidat::where('Nom','like',"%$request%")->orWhere('Prenom','like',"%$request%")->paginate(7);
          //$users = Candidat::where('Nom');
          //dd($users);
          //dd($var,$request);

          $data2 = DB::select('SELECT * FROM hobies');
          $appreciations = DB::select('SELECT * FROM appreciations');
          $Villes = DB::select('SELECT * FROM Villes');
          $data3 = DB::select('SELECT * FROM hobie_candidats');
          $data4 = DB::select('SELECT * FROM technologies');
          $data5 = DB::select('SELECT * FROM technologie_candidats');
            $var = Candidat::select("*");
            if($request->nom != null){
                $var = $var->where('Nom', 'LIKE', "%{$request->input('nom')}%")
                ->orWhere('Prenom', 'LIKE', "%{$request->input('nom')}%")
                ->orWhere('CIN', 'LIKE', "%{$request->input('nom')}%");
            }
            if($request->Appreciation){
                $var = $var->where('Appreciation' , $request->Appreciation);
            }
            if($request->Sexe != -1 ){
                $var = $var->where('Sexe' , $request->Sexe);
            }
            if($request->Ville){
                $var = $var->where('Ville' , $request->Ville);
            }
            if($request->NombreDanneesDexperience){
                $var = $var->where('NombreDanneesDexperience' , $request->NombreDanneesDexperience);
            }
            if($request->Pattern){
                $var = $var->where('motife' , $request->Pattern);
            }
            //dd($var->get());
            $var = $var->paginate(7);
            //dd($var);
          return view('admin.candidat',[
              'users' => $var, 
              'hobies' => $data2,
              'hobie_candidats' => $data3,
              'technologies' => $data4,
              'technologie_candidats' => $data5,
              'id'=>$id,
              'appreciations' => $appreciations,
              'Villes' => $Villes,
              ]);//compact('users','data1','var','data2','data3','id'));
    }













    public function TH(){
        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }
    public function add_T(){
        return view('admin.add_t');
    }
    public function store_T(Request $request){
        Technologies::create([
            'name' => $request->technologie,
        ]);

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        
        return view('admin.th' , compact('technologies','hobies'));
    }
    public function add_H(){
        return view('admin.add_h');
    }
    public function store_H(Request $request){
        //dd($request);
        Hobies::create([
            'name' => $request->Hobie,
        ]);

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        
        return view('admin.th' , compact('technologies','hobies'));
    }

    public function edit_t(Technologies $technologies){
        return view('admin.edit_t' , compact('technologies'));
    }

    public function update_t(Request $request, Technologies $technologies){
        
        $technologies->update([
            'name'=> $request->technologie,
            ]);

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }

    public function edit_h(Request $request, Hobies $hobies){
        //dd($request);
        return view('admin.edit_h' , compact('hobies'));
    }







    public function update_h_c_e(Request $request, $id){
        $hobies = Hobies::find($id); 
        $hobies->active = 1;
        $hobies->save();

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }
    public function update_h_c_d(Request $request, $id){
        $hobies = Hobies::find($id); 
        $hobies->active = 0;
        $hobies->save();

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }








    public function update_t_c_e(Request $request, $id){
        $technologies = Technologies::find($id); 
        $technologies->active = 1;
        $technologies->save();

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }
    public function update_t_c_d(Request $request, $id){
        $technologies = Technologies::find($id); 
        $technologies->active = 0;
        $technologies->save();

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }







public function update_c_e(Request $request, $_id){
        $candidat = Candidat::find($_id); 
        $candidat->active = 1;
        $candidat->save();

        $id=Auth::user()->id;
         // $data1 = DB::select('SELECT * FROM candidats');
          //$searchTerm = '%'.$this->searchTerm.'%';
          $var=Candidat::query()->paginate(7);
          $data2 = DB::select('SELECT * FROM hobies');
          $data3 = DB::select('SELECT * FROM hobie_candidats');
          $data4 = DB::select('SELECT * FROM technologies');
          $data5 = DB::select('SELECT * FROM technologie_candidats');
          $data6 = DB::select('SELECT * FROM appreciations');
          $data7 = DB::select('SELECT * FROM villes');
          $users = Candidat::all();
          //$users = Candidat::where('Nom');
          
          return view('admin.candidat',[
              'users' => $var, 
              'hobies' => $data2,
              'hobie_candidats' => $data3,
              'technologies' => $data4,
              'technologie_candidats' => $data5,
              'appreciations' => $data6,
              'Villes' => $data7,
              'id'=>$id
              ]);
    }
    public function update_c_d(Request $request, $id){
        $candidat = Candidat::find($id); 
        $candidat->active = 0;
        $candidat->save();

        $id=Auth::user()->id;
         // $data1 = DB::select('SELECT * FROM candidats');
          //$searchTerm = '%'.$this->searchTerm.'%';
          $var=Candidat::query()->paginate(7);
          $data2 = DB::select('SELECT * FROM hobies');
          $data3 = DB::select('SELECT * FROM hobie_candidats');
          $data4 = DB::select('SELECT * FROM technologies');
          $data5 = DB::select('SELECT * FROM technologie_candidats');
          $data6 = DB::select('SELECT * FROM appreciations');
          $data7 = DB::select('SELECT * FROM villes');
          $users = Candidat::all();
          //$users = Candidat::where('Nom');
          
          return view('admin.candidat',[
              'users' => $var, 
              'hobies' => $data2,
              'hobie_candidats' => $data3,
              'technologies' => $data4,
              'technologie_candidats' => $data5,
              'appreciations' => $data6,
              'Villes' => $data7,
              'id'=>$id
              ]);
    }








    public function update_h(Request $request, Hobies $hobies){
        
        $hobies->update([
            'name'=> $request->Hobie,
            ]);

        $technologies = DB::select('SELECT * FROM technologies');
        $hobies = DB::select('SELECT * FROM hobies');
        return view('admin.th',[
            'hobies' => $hobies,
            'technologies' => $technologies,
            ]);
    }
}
