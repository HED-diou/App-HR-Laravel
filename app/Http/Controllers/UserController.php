<?php

namespace App\Http\Controllers;
use Mail;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cron;
use App\Models\Company;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;
use App\Rules\isNotOldPassword;
use App\Rules\IsStrongPassword;
use App\Rules\IsValidBirthDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $sql="SELECT * from users where id= $user_id";
        $user = DB::select(DB::raw($sql));
       // $sql2='SELECT COUNT(*) as conge FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE r.user_id =' . Auth::user()->id . ' AND rh.statut = 2 ORDER BY rh.updated_at DESC, rh.request_id';
      //  $countcong=DB::select(DB::raw($sql2));
        $sql3="SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE (SELECT DATE(now()) from DUAL) BETWEEN rh.start_date AND rh.end_date AND rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) AND rh.statut = 2 ORDER BY rh.updated_at DESC, r.user_id";
        $empcongs=DB::select(DB::raw($sql3));
        $countempcong=count($empcongs);
        $requests = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) AND r.user_id =' . Auth::user()->id . ' ORDER BY  rh.updated_at DESC, r.user_id  LIMIT 5' );
        $request_history = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE r.user_id =' . Auth::user()->id . ' ORDER BY rh.updated_at DESC, rh.request_id' );
        $countreq=count($requests);
        $bankdays=DB::table('bank_holiday')->get();
        $types = DB::table('holiday_type')->get();
        $companies = DB::select('SELECT * FROM companies');
        $sql4="SELECT * from bank_holiday where start_date>= now() limit 1";
        $proche_bankday=DB::select(DB::raw($sql4));

        return view('user.index', compact($companies, 'bankdays','user_id','requests','countreq','types',"user","empcongs","countempcong","request_history","proche_bankday"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *     admin cron  execute date Page
     */
    public function cron()
    {
        return view('setting.cron');

    }
    /**
     *     admin cron  execute date Page
     */
    public function cron_update(Request $request,Cron $cron)
    {
        $month = date("m",strtotime($request['date_execution']));
        $sql="select * from crons";
        $date=DB::select(DB::raw($sql));
        $request->validate([
            'date_execution' => 'required',
        ],
         [   'date_execution.required'=>'The Execution date is required , please fill in the field',]
        );
        if(count($date)>0){
            DB::table('crons')
                ->update(array('date_execution' => $request['date_execution']));
            return redirect()->route('setting.cron')->with('success','The execution date of the cron has been updated');
        }else{
            DB::table('crons')->insert(
                array('date_execution' => $request['date_execution'])
            );
            return redirect()->route('setting.cron')->with('success','The execution date of the cron has been inserted');
        }
    }
    /**
     * User Profile Page
     *
     *
     */
    public function profile()
    {
        $companies = DB::select('SELECT * FROM companies');
        $managers = DB::select('SELECT * FROM users');
        $AuthUserCompany = DB::select('SELECT name FROM companies WHERE id =' . Auth::user()->company_id );
        if (Auth::user()->manager ==null){
            $AuthUserManager = DB::select('SELECT firstname, lastname FROM users WHERE id is NULL ');
        }
        if (Auth::user()->manager !=null){
            $AuthUserManager = DB::select('SELECT firstname, lastname FROM users WHERE id =' . Auth::user()->manager );
        }
        return view('user.profile', compact('companies', 'managers', 'AuthUserCompany','AuthUserManager'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Change Password after User First connection.
     *
     *
     */
    public function change_password(User $user)
    {

        $user = Auth::user(); if($user->admin==0){  return view('user.change-password', compact('user'));}else{     return redirect()->route('user');}

    }

    public function change_password_validate(Request $request, User $user)
    {
        date_default_timezone_set('Africa/Casablanca');
        $date = date('d-m-y h:i:s');
        $request->validate([
            'password' => ['required','confirmed','string','min:6', new isNotOldPassword(), new IsStrongPassword()],
        ]);
        $user->password = $request['password'];
        $user->connected_at = $date;
        $user->save();
        Auth::login($user);

        return redirect()->route('user')
                        ->with('success','Account validated successfully');
    }

    /**
     * Change Password after User First connection.
     *
     *
     */
    public function change_pass(User $user, $token )
    {
        date_default_timezone_set('Africa/Casablanca');
        $date = date('Y-m-d H:i:s');

        $user = $user->attributesToArray();

        $error= 'Token is incorrect, please test again.';
        if($user['token']==$token)
        {
            if ($user['Token_endD'] >= $date){

                return view('user.change-pass', compact('user'));
            }
            else{
                DB::table('users')->where('id',$user['id'])->update(array(
                    'token'=>null
                ));
                $error='The validity of the token has expired.';
            }
        }
        return redirect()->route('login')  ->with('error', $error);

    }

    public function change_pass_validate(Request $request, User $user)
    {
        date_default_timezone_set('Africa/Casablanca');
        $date = date('Y-m-d H:i:s');
        $request->validate([
            'password' => ['required','confirmed','string','min:6',  new IsStrongPassword()],
        ]);
        $user->password = $request['password'];
        $user->connected_at = $date ;
        $user->token=null;

        $user->save();
        $utilisateur=$user->attributesToArray();
        $to_name = $utilisateur['firstname'] ." ".$utilisateur['lastname'];
        $to_email = $utilisateur['email'];
        $data = array('name'=>$utilisateur['firstname'] ." ".$utilisateur['lastname'], "body" => ' We inform you that your password for the wave account '.$to_email.' was changed on'.$date.'.');
        Mail::send('pwd_email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Password  changed.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });
        Auth::login($user);

        return redirect()->route('user')
            ->with('success','Account validated successfully');
    }
    public function reset_passwd(User $user, $token )
    {
        date_default_timezone_set('Africa/Casablanca');
        $date = date('Y-m-d H:i:s');
        $user = $user->attributesToArray();

        $error= 'Token is incorrect, please test again.';
       if($user['reset_token']==$token)
       {
           if ($user['reset_token_endd'] >= $date){

               return view('user.reset-passwd', compact('user'));
           }
           else{
               DB::table('users')->where('id',$user['id'])->update(array(
                   'reset_token'=>null
               ));
               $error='The validity of the token has expired.';
           }
       }
       return redirect()->route('login')  ->with('error', $error);

    }

    public function reset_passwd_validate(Request $request, User $user)
    {
        date_default_timezone_set('Africa/Casablanca');
        $date = date('Y-m-d H:i:s');
        $request->validate([
            'password' => ['required','confirmed','string','min:6',  new IsStrongPassword()],
        ]);
        $user->password = $request['password'];
        $user->connected_at = $date ;
        $user->reset_token=null;
        $user->save();
        $utilisateur=$user->attributesToArray();
        $to_name = $user->firstname ." ".$utilisateur['lastname'];
        $to_email = $utilisateur['email'];
        $data = array('name'=>$utilisateur['firstname'] ." ".$utilisateur['lastname'], "body" => ' We inform you that your password for the wave account '.$to_email.'was changed on'.$date.'.');
        Mail::send('pwd_email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Password  changed.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });
        Auth::login($user);
        return redirect()->route('user')->with('success','Password changed successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {   date_default_timezone_set('Africa/Casablanca');
        $date = date('Y-m-d H:i:s');
        $AuthUserCompany = DB::select('SELECT name FROM companies WHERE id =' . Auth::User()->company_id );
        if (Auth::user()->manager ==null){
            $AuthUserManager = DB::select('SELECT firstname, lastname FROM users WHERE id is NULL ');
        }
        if (Auth::user()->manager !=null){
            $AuthUserManager = DB::select('SELECT firstname, lastname FROM users WHERE id =' . Auth::user()->manager );
        }
        $request->validate([
            'password' => ['nullable','confirmed','string','min:6', new isNotOldPassword(), new IsStrongPassword()],
            'tel' => 'nullable|digits:10',
        ]);
        if(Auth::user()->hasRole('admin'))
        {
            $request->validate([
                'password' => ['nullable','confirmed','string','min:6', new isNotOldPassword(), new IsStrongPassword()],
                'tel' => 'nullable|digits:10',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required | unique:users,email,'.$user->id,
                'hiredate' => 'required',
                'company_id' => 'required',
                'birthdate' => ['nullable', new IsValidBirthDate()],
            ]);
            $user->firstname = $request->get('firstname');
            $user->lastname = $request->get('lastname');
            $user->email = $request->get('email');
            $user->hiredate = $request->get('hiredate');
            $user->tel = $request->get('tel');
            $user->company_id = $request->get('company_id');
            $user->birthdate = $request->get('birthdate');
            $user->address = $request->get('address');
            $user->password = $request->get('password');
            $oldpass= $request->get('oldpass');
            $user->save();
              if($oldpass == $user->password){
                  $to_name=$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ];
                  $to_email=$user->attributesToArray()['email' ];
                  $data = array('name'=>$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ], "body" => 'You have successfully updated your Wave HR account. ');
                  Mail::send('emails', $data, function($message) use ($to_name,$to_email ) {
                      $message->to($to_email, $to_name)->subject('Wave HR> Profile changed.');
                      $message->from(config('mail.from.address'),'Wave HR Team');
                  });
              }
              else
              {

                  $to_name=$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ];
                  $to_email=$user->attributesToArray()['email' ];
                  $data = array('name'=>$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ], "body" => 'We inform you that your password for the wave account '.$to_email.'was changed on'.$date.'.');
                  Mail::send('pwd_email', $data, function($message) use ($to_name,$to_email ) {
                      $message->to($to_email, $to_name)->subject('Wave HR> Password  changed.');
                      $message->from(config('mail.from.address'),'Wave HR Team');});
              }
        }
        else
        {
            $request->validate([
                'password' => ['nullable','confirmed','string','min:6', new isNotOldPassword(), new IsStrongPassword()],
                'password' => ['nullable','confirmed','string','min:6', new isNotOldPassword(), new IsStrongPassword()],
                'tel' => 'nullable|digits:10',
            ]);
            $user->tel = $request->get('tel');
            $user->address = $request->get('address');
            $user->password = $request->get('password');
            $oldpass= $request->get('oldpass');
            $user->save();
            if($oldpass == $user->password){
                $to_name=$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ];
                $to_email=$user->attributesToArray()['email' ];
                $data = array('name'=>$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ], "body" => ' You have successfully updated your Wave HR account. ');
                Mail::send('emails', $data, function($message) use ($to_name,$to_email ) {
                    $message->to($to_email, $to_name)->subject('Wave HR> Profile changed.');
                    $message->from(config('mail.from.address'),'Wave HR Team');
                });
            }
            else
            {
                $to_name=$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ];
                $to_email=$user->attributesToArray()['email' ];
                $data = array('name'=>$user->attributesToArray()['firstname' ]." ".$user->attributesToArray()['lastname' ], "body" => ' We inform you that your password for the wave account '.$to_email.'was changed on'.$date.'.');
                Mail::send('pwd_email', $data, function($message) use ($to_name,$to_email ) {
                    $message->to($to_email, $to_name)->subject('Wave HR> Password  changed.');
                    $message->from(config('mail.from.address'),'Wave HR Team');});
            }
        }
        return redirect()->route('user.profile',compact('AuthUserCompany','AuthUserManager'))
            ->with('success','Profile updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
