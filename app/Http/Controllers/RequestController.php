<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Requeste;
use App\Models\RequestsHistory;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Rules\isCommentRequired;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->hasRole('admin'))
        {
            $request_history = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id ORDER BY rh.updated_at DESC, rh.request_id');
            $requestsa = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment,
 rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype,
  u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn
  FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON
  rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) ORDER BY  rh.updated_at DESC, r.user_id');
           /* $requests=Requeste::query()->Paginate(1);
            $requests=Requeste::query()->paginate(1);
            $var = Requeste::find(2);
            dd($var->last_req);

          ;*/
            $maxids=DB::table('requests_history')->select( DB::raw('MAX(id) as maxid')) ->groupBy('request_id')->get();
            $max=[];
            foreach ($maxids as $maxid){
                $max[]=$maxid->maxid;
            }
            $requests = DB::table('requests_history')
                ->leftjoin('requests', 'requests_history.request_id', '=', 'requests.id')
                ->leftjoin('statutes', 'requests_history.statut', '=', 'statutes.id')
                ->leftjoin('users', 'requests_history.admin_id', '=', 'users.id')
                ->leftjoin('users as uu', 'requests.user_id', '=', 'uu.id')
                ->wherein('requests_history.id',$max)
                ->orderBy('requests_history.updated_at', 'desc')
                ->orderBy('requests.user_id')
                ->select('users.*','users.firstname as adminfn','users.lastname as adminln','uu.lastname as requesterfn', 'uu.firstname as requesterln', 'requests.*', 'statutes.*','requests_history.*','uu.*')
                ->paginate(7);
        }
        else
        {
            $request_history = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE r.user_id =' . Auth::user()->id . ' ORDER BY rh.updated_at DESC, rh.request_id' );
            $requestsa = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment,
 rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn,
  u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh
  LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu
  ON r.user_id = uu.id WHERE rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) AND r.user_id =' . Auth::user()->id . ' ORDER BY  rh.updated_at DESC, r.user_id ' );


            $maxids=DB::table('requests_history')->select( DB::raw('MAX(id) as maxid')) ->groupBy('request_id')->get();
            $max=[];
            foreach ($maxids as $maxid){
                $max[]=$maxid->maxid;
            }
            $requests = DB::table('requests_history')
                ->leftjoin('requests', 'requests_history.request_id', '=', 'requests.id')
                ->leftjoin('statutes', 'requests_history.statut', '=', 'statutes.id')
                ->leftjoin('users', 'requests_history.admin_id', '=', 'users.id')
                ->leftjoin('users as uu', 'requests.user_id', '=', 'uu.id')
                ->wherein('requests_history.id',$max)
                ->where('requests.user_id',Auth::user()->id)
                ->orderBy('requests_history.updated_at', 'desc')
                ->orderBy('requests.user_id')
                ->select('users.*','users.firstname as adminfn','users.lastname as adminln','uu.lastname as requesterfn', 'uu.firstname as requesterln', 'requests.*', 'statutes.*','requests_history.*','uu.*')
                ->paginate(7);

        }
        return view('requests.index', compact('requests', 'user', 'request_history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $holidays = Holiday::All();
        return view('requests.create', compact('holidays'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if($user->hasRole('admin'))
        {

            $request_history = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id ORDER BY rh.updated_at DESC, rh.request_id');
            $requests = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at,
                                rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut,
                                rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived,
                                s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id
                                LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE rh.id IN (SELECT MAX(id) as maxid
                                FROM requests_history GROUP BY request_id) ORDER BY  rh.updated_at DESC, r.user_id');

        }
        else
        {
            $request_history = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE r.user_id =' . Auth::user()->id . ' ORDER BY rh.updated_at DESC, rh.request_id' );
            $requests = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE rh.id IN (SELECT MAX(id) as maxid FROM requests_history GROUP BY request_id) AND r.user_id =' . Auth::user()->id . ' ORDER BY  rh.updated_at DESC, r.user_id ' );
        }
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
                'holidaytype' => 'required',
                'dayscount' => 'required|numeric|min:0.5',
            ]);
        if($request['holidaytype'] == 2)
        {
            $request->validate([
                'comment' => 'required'
            ]);
        }
        $requests = Requeste::make([
            'archived' => $request['archived'],
            'user_id' => Auth::user()->id
        ]);
        $requests->save();
        $now = Carbon::now();
        $request_history = RequestsHistory::make([
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'dayscount' => $request['dayscount'],
            'updated_at' => $now,
            'comment' => $request['comment'],
            'leaving_at_evening' => $request['leaving_at_evening'],
            'coming_at_evening' => $request['coming_at_evening'],
            'request_id' => $requests->id,
            'holidaytype' => $request['holidaytype'],
            'statut' => 1,
        ]);
        $request_history->save();
        $emetteur=Auth::user()->attributesToArray();
        $to_name = $emetteur['firstname'] ." ".$emetteur['lastname'];
        $to_email = $emetteur['email'];
        $data = array('name'=>$emetteur['firstname'] ." ".$emetteur['lastname'], "body" => ' We acknowledge receipt of your leave request and thank you.');
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> New leave request.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });
        $sql="SELECT * from users where admin= 1";
        $admins = DB::select(DB::raw($sql));
        for($i=0;$i<count($admins);$i++)
        {
            $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
            $email=$admins[$i]->email;
            $data = array('name'=>$name, "body" => 'A new leave request has been created by '.$to_name.' on '.Carbon::now().'.');
            Mail::send('emails', $data, function($message) use ($name,$email ) {
                $message->to($email, $name)->subject('Wave HR> New leave request.');
                $message->from(config('mail.from.address'),'Wave HR Team');
            });
        }

         return redirect()->route('requests',compact('requests', 'user', 'request_history'))
                        ->with('success','Request created successfully.');
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
    public function edit(Requeste $request)
    {
         $ownership = 1;

        if(Auth::user()->id != $request->user_id)
        {
            $ownership = 0;
        }

        $requestinfos = DB::select('SELECT * FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id AND r.user_id =' . Auth::user()->id . ' LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN holidays as h ON rh.holidaytype=h.id WHERE rh.request_id =' . $request->id . ' ORDER BY rh.updated_at DESC LIMIT 1');
        $holidays = Holiday::All();

        return view('requests.edit', ['requests' => $requestinfos[0], 'holidays' => $holidays, 'ownership' => $ownership]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, Requeste $request)
    {
        $requestinfos = DB::select('SELECT * FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id WHERE rh.request_id =' . $request->id . ' ORDER BY rh.updated_at DESC LIMIT 1');
        $user = Auth::user();


        if($requests['holidaytype'] == 2)
        {
            $requests->validate([
                'comment' => 'required'
            ]);
        }

        $now = Carbon::now();

        if($user->hasRole('admin'))
        {
                $requests->validate([
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'holidaytype' => 'required',
                    'dayscount' => 'required|numeric|min:0.5|max:"30"',
                ]);
                $request_history = RequestsHistory::make([
                    'start_date' => $requests['start_date'],
                    'end_date' => $requests['end_date'],
                    'dayscount' => $requests['dayscount'],
                    'updated_at' => $now,
                    'comment' => $requests['comment'],
                    'admincomment' => $requests['admincomment'],
                    'leaving_at_evening' => $requests['leaving_at_evening'],
                    'coming_at_evening' => $requests['coming_at_evening'],
                    'request_id' => $request->id,
                    'holidaytype' => $requests['holidaytype'],
                    'latest_action' => 3,
                    'statut' => 1,
                    'admin_id' => $user->id,
                      ]);
        }
        else
        {

                $requests->validate([
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'holidaytype' => 'required',
                    'dayscount' => 'required|numeric|min:0.5|max:"30"',
                ]);

                $request_history = RequestsHistory::make([
                    'start_date' => $requests['start_date'],
                    'end_date' => $requests['end_date'],
                    'dayscount' => $requests['dayscount'],
                    'updated_at' => $now,
                    'comment' => $requests['comment'],
                    'leaving_at_evening' => $requests['leaving_at_evening'],
                    'coming_at_evening' => $requests['coming_at_evening'],
                    'request_id' => $request->id,
                    'holidaytype' => $requests['holidaytype'],
                    'latest_action' => 1,
                    'statut' => 1,
                ]);
        }
        $request_history->save();
        return redirect()->route('requests')
                        ->with('success','Request updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Requeste $request, Request $requeste)
    {

        $requests = DB::select('SELECT * FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id WHERE rh.request_id = '. $request->id .' ORDER BY rh.id DESC LIMIT 1');
        $now = Carbon::now();

        $request_history = RequestsHistory::make([
            'start_date' => $requests[0]->start_date,
            'end_date' => $requests[0]->end_date,
            'dayscount' => $requests[0]->dayscount,
            'updated_at' => $now,
            'comment' => $requeste['comment'],
            'leaving_at_evening' => $requests[0]->leaving_at_evening,
            'coming_at_evening' => $requests[0]->coming_at_evening,
            'request_id' => $request->id,
            'holidaytype' => $requests[0]->holidaytype,
            'latest_action' => 2,
            'statut' => 1,
        ]);
            $request_history->save();

        $sql="SELECT user_id from requests where id= $request->id";
        $requester_id = DB::select(DB::raw($sql));

        $sql2="SELECT * from users where id= ".$requester_id[0]->user_id;
        $requester = DB::select(DB::raw($sql2));


        $to_name = $requester[0]->firstname ." ".$requester[0]->lastname;
        $to_email = $requester[0]->email;
        $data = array('name'=>$requester[0]->firstname ." ".$requester[0]->lastname, "body" => ' Your leave request number '.$request->id.' was canceled on '.Carbon::now().'.');
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Leave request canceled.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });

        $sql="SELECT * from users where admin= 1";
        $admins = DB::select(DB::raw($sql));
        for($i=0;$i<count($admins);$i++)
        {
            $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
            $email=$admins[$i]->email;
            $data = array('name'=>$name, "body" => 'Leave request number '.$request->id.' was canceled by '.$to_name.'.');
            Mail::send('emails', $data, function($message) use ($name,$email ) {
                $message->to($email, $name)->subject('Wave HR> Leave request canceled.');
                $message->from(config('mail.from.address'),'Wave HR Team');
            });
        }

            return redirect()->route('requests')
                        ->with('success','Request canceled successfully ');
    }

    public function history()
    {
        $user = Auth::user();

        if($user->hasRole('admin'))
        {
            $requests = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id ORDER BY r.user_id, rh.updated_at DESC');
        }
        else
        {
             $requests = DB::select('SELECT rh.id, rh.start_date, rh.end_date, rh.dayscount, rh.updated_at, rh.admincomment, rh.comment, rh.leaving_at_evening, rh.coming_at_evening, rh.latest_action, rh.statut, rh.admin_id, rh.request_id, rh.holidaytype, u.firstname as adminfn, u.lastname as adminln, r.user_id, r.archived, s.name, s.label, uu.firstname as requesterln, uu.lastname as requesterfn FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN statutes as s ON rh.statut = s.id LEFT JOIN users as u ON rh.admin_id = u.id LEFT JOIN users as uu ON r.user_id = uu.id WHERE r.user_id =' . Auth::user()->id . ' ORDER BY rh.request_id, rh.updated_at DESC' );
        }



        return view('requests.history', compact('requests'));
    }

    public function validate_(Request $requeste, Requeste $request)
    {

        $requests = DB::select('SELECT * FROM requests_history as rh LEFT JOIN requests as r ON rh.request_id = r.id LEFT JOIN users as u ON r.user_id = u.id WHERE rh.request_id = '. $request->id .' ORDER BY rh.id DESC LIMIT 1');
        $now = Carbon::now();
        $user = Auth::user();

        if($requests[0]->latest_action == 2 )
        {
            $request_history = RequestsHistory::make([
                'start_date' => $requests[0]->start_date,
                'end_date' => $requests[0]->end_date,
                'dayscount' => $requests[0]->dayscount,
                'updated_at' => $now,
                'comment' => $requests[0]->comment,
                'admincomment' => $requeste['admincomment'],
                'leaving_at_evening' => $requests[0]->leaving_at_evening,
                'coming_at_evening' => $requests[0]->coming_at_evening,
                'request_id' => $request->id,
                'holidaytype' => $requests[0]->holidaytype,
                'latest_action' => 6,
                'statut' => 4,
                'admin_id' => $user->id,
            ]);

            $request_history->save();

        $check_if_validated = DB::select('SELECT * FROM requests_history WHERE request_id='. $request->id . ' AND statut = 2 ORDER BY updated_at DESC LIMIT 1 ');

        if($check_if_validated != null)
        {
            $current_balance = DB::select('SELECT balance, firstname, lastname FROM users WHERE id= ' . $requests[0]->user_id);
            DB::table('users')->where('id', $requests[0]->user_id)->update(['balance' =>   $current_balance[0]->balance + $check_if_validated[0]->dayscount]);

            return redirect()->route('requests')
                                ->with('success','Request canceled successfully, User : '. $current_balance[0]->firstname .' '. $current_balance[0]->firstname.' got refunded for '. $check_if_validated[0]->dayscount . ' day(s)');
        }
        else
        {
            $sql="SELECT user_id from requests where id= $request->id";
            $requester_id = DB::select(DB::raw($sql));

            $sql2="SELECT * from users where id= ".$requester_id[0]->user_id;
            $requester = DB::select(DB::raw($sql2));
            $sql3="SELECT * from users where id= ". $user->id;
            $admin = DB::select(DB::raw($sql3));

            $to_name = $requester[0]->firstname ." ".$requester[0]->lastname;
            $to_email = $requester[0]->email;
            $data = array('name'=>$requester[0]->firstname ." ".$requester[0]->lastname, "body" => ' We would like to inform you that your leave request number '.$request->id.' was canceled by one of the platform administrators.');
            Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Wave HR> Leave request canceled.');
                $message->from(config('mail.from.address'),'Wave HR Team');
            });

            $sql="SELECT * from users where admin= 1";
            $admins = DB::select(DB::raw($sql));
            for($i=0;$i<count($admins);$i++)
            {
                $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
                $email=$admins[$i]->email;
                $data = array('name'=>$name, "body" => ' Leave request number '.$request->id.' was canceled by '.$admin[0]->firstname.' '.$admin[0]->lastname.'.');
                Mail::send('emails', $data, function($message) use ($name,$email ) {
                    $message->to($email, $name)->subject('Wave HR> Leave request canceled.');
                    $message->from(config('mail.from.address'),'Wave HR Team');
                });
            }
            return redirect()->route('requests')
            ->with('success','Request canceled successfully');
        }
        }
        else
        {
            $check_if_validated = DB::select('SELECT * FROM requests_history WHERE request_id='. $request->id . ' AND statut = 2 ORDER BY updated_at DESC LIMIT 1 ');
            $request_history = RequestsHistory::make([
                'start_date' => $requests[0]->start_date,
                'end_date' => $requests[0]->end_date,
                'dayscount' => $requeste['dayscount'],
                'updated_at' => $now,
                'comment' => $requests[0]->comment,
                'admincomment' => $requeste['admincomment'],
                'leaving_at_evening' => $requests[0]->leaving_at_evening,
                'coming_at_evening' => $requests[0]->coming_at_evening,
                'request_id' => $request->id,
                'holidaytype' => $requests[0]->holidaytype,
                'latest_action' => 4,
                'statut' => 2,
                'admin_id' => $user->id,
                ]);
                $request_history->save();
                $current_balance = DB::select('SELECT balance, firstname, lastname FROM users WHERE id= ' . $requests[0]->user_id);
                if($check_if_validated != null)
            {
                DB::table('users')->where('id', $requests[0]->user_id)->update(['balance' =>   $current_balance[0]->balance + $check_if_validated[0]->dayscount]);
            }
                DB::table('users')->where('id', $requests[0]->user_id)->update(['balance' =>   $current_balance[0]->balance - $requeste['dayscount']]);
                $sql="SELECT user_id from requests where id= $request->id";
                $requester_id = DB::select(DB::raw($sql));
                $sql2="SELECT * from users where id= ".$requester_id[0]->user_id;
                $requester = DB::select(DB::raw($sql2));
                $sql3="SELECT * from users where id= ". $user->id;
                $admin = DB::select(DB::raw($sql3));
                $to_name = $requester[0]->firstname ." ".$requester[0]->lastname;
                $to_email = $requester[0]->email;
                $data = array('name'=>$requester[0]->firstname ." ".$requester[0]->lastname, "body" => ' We would like to inform you that your leave request number '.$request->id.' was validated by one of the platform administrators.');
                Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('Wave HR> Leave request validated.');
                    $message->from(config('mail.from.address'),'Wave HR Team');
                });
                $sql="SELECT * from users where admin= 1";
                $admins = DB::select(DB::raw($sql));
                for($i=0;$i<count($admins);$i++)
                {
                    $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
                    $email=$admins[$i]->email;
                    $data = array('name'=>$name, "body" => ' The leave request number '.$request->id.' has been validated by '.$admin[0]->firstname.' '.$admin[0]->lastname.'.');
                    Mail::send('emails', $data, function($message) use ($name,$email ) {
                        $message->to($email, $name)->subject('Wave HR> Leave request validated.');
                        $message->from(config('mail.from.address'),'Wave HR Team');
                    });
                }
                return redirect()->route('requests')


                                ->with('success','Request validated successfully.');
        }
    }
    public function refuse(Request $requeste, Requeste $request)
    {
        $requests = DB::select('SELECT * FROM requests_history WHERE request_id = '. $request->id .' ORDER BY id DESC LIMIT 1');
        $now = Carbon::now();
        $user = Auth::user();
        $check_if_validated = DB::select('SELECT * FROM requests_history WHERE request_id='. $request->id . ' AND statut = 2 ORDER BY updated_at DESC LIMIT 1 ');

            $request_history = RequestsHistory::make([
                'start_date' => $requests[0]->start_date,
                'end_date' => $requests[0]->end_date,
                'dayscount' => $requests[0]->dayscount,
                'updated_at' => $now,
                'comment' => $requests[0]->comment,
                'admincomment' => $requeste['admincomment'],
                'leaving_at_evening' => $requests[0]->leaving_at_evening,
                'coming_at_evening' => $requests[0]->coming_at_evening,
                'request_id' => $request->id,
                'holidaytype' => $requests[0]->holidaytype,
                'latest_action' => 5,
                'statut' => 3,
                'admin_id' => $user->id,
            ]);

            $request_history->save();

            $current_balance = DB::select('SELECT balance, firstname, lastname FROM users WHERE id= ' . $request->user_id);

            if($check_if_validated != null)
        {
            DB::table('users')->where('id', $request->user_id)->update(['balance' =>   $current_balance[0]->balance + $check_if_validated[0]->dayscount]);
        }

        $sql="SELECT user_id from requests where id= $request->id";
        $requester_id = DB::select(DB::raw($sql));

        $sql2="SELECT * from users where id= ".$requester_id[0]->user_id;
        $requester = DB::select(DB::raw($sql2));
        $sql3="SELECT * from users where id= ". $user->id;
        $admin = DB::select(DB::raw($sql3));

        $to_name = $requester[0]->firstname ." ".$requester[0]->lastname;
        $to_email = $requester[0]->email;
        $data = array('name'=>$requester[0]->firstname ." ".$requester[0]->lastname, "body" => ' We would like to inform you that your leave request number '.$request->id.'was refused by one of the platform administrators.');
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Request for leave refused.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });

        $sql="SELECT * from users where admin= 1";
        $admins = DB::select(DB::raw($sql));
        for($i=0;$i<count($admins);$i++)
        {
            $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
            $email=$admins[$i]->email;
            $data = array('name'=>$name, "body" => ' Leave request number '.$request->id.' was refused by '.$admin[0]->firstname.' '.$admin[0]->lastname.'.');
            Mail::send('emails', $data, function($message) use ($name,$email ) {
                $message->to($email, $name)->subject('Wave HR> Request for leave refused.');
                $message->from(config('mail.from.address'),'Wave HR Team');
            });
        }

            return redirect()->route('requests')
                            ->with('success','Request refused successfully.');
    }

    public function archive(Requeste $request, Request $requeste)
    {
        $requests = DB::select('SELECT * FROM requests_history WHERE request_id = '. $request->id .' ORDER BY id DESC LIMIT 1');
        $now = Carbon::now();
        $user = Auth::user();

        $request_ = RequestsHistory::make([
            'start_date' => $requests[0]->start_date,
            'end_date' => $requests[0]->end_date,
            'dayscount' => $requests[0]->dayscount,
            'updated_at' => $now,
            'comment' => $requests[0]->comment,
            'admincomment' => $requeste['admincomment'],
            'leaving_at_evening' => $requests[0]->leaving_at_evening,
            'coming_at_evening' => $requests[0]->coming_at_evening,
            'request_id' => $request->id,
            'holidaytype' => $requests[0]->holidaytype,
            'latest_action' => 7,
            'statut' => 5,
            'admin_id' => $user->id,
        ]);
        DB::table('requests')->where('id', $request->id)->update(['archived' => 1]);

        $request_->save();

        $sql="SELECT user_id from requests where id= $request->id";
        $requester_id = DB::select(DB::raw($sql));

        $sql2="SELECT * from users where id= ".$requester_id[0]->user_id;
        $requester = DB::select(DB::raw($sql2));
        $sql3="SELECT * from users where id= ". $user->id;
        $admin = DB::select(DB::raw($sql3));

        $to_name = $requester[0]->firstname ." ".$requester[0]->lastname;
        $to_email = $requester[0]->email;
        $data = array('name'=>$requester[0]->firstname ." ".$requester[0]->lastname, "body" => ' We would like to inform you that your leave request numbeR '.$request->id.' was archived by one of the platform administrators.');
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Wave HR> Leave request archived.');
            $message->from(config('mail.from.address'),'Wave HR Team');
        });

        $sql="SELECT * from users where admin= 1";
        $admins = DB::select(DB::raw($sql));
        for($i=0;$i<count($admins);$i++)
        {
            $name=$admins[$i]->firstname ." ".$admins[$i]->lastname;
            $email=$admins[$i]->email;
            $data = array('name'=>$name,"body" => 'Leave request number '.$request->id.' was archived by '.$admin[0]->firstname.' '.$admin[0]->lastname.'.');
            Mail::send('emails', $data, function($message) use ($name,$email ) {
                $message->to($email, $name)->subject('Wave HR> Leave request archived.');
                $message->from(config('mail.from.address'),'Wave HR Team');
            });
        }

        return redirect()->route('requests')
                        ->with('success','Request archived successfully.');
    }

    public function unarchive(Requeste $request, Request $requeste)
    {
        $requests = DB::select('SELECT * FROM requests_history WHERE request_id = '. $request->id .' ORDER BY id DESC LIMIT 1');
        $now = Carbon::now();
        $user = Auth::user();

        $request_ = RequestsHistory::make([
            'start_date' => $requests[0]->start_date,
            'end_date' => $requests[0]->end_date,
            'dayscount' => $requests[0]->dayscount,
            'updated_at' => $now,
            'comment' => $requests[0]->comment,
            'admincomment' => $requests[0]->admincomment,
            'leaving_at_evening' => $requests[0]->leaving_at_evening,
            'coming_at_evening' => $requests[0]->coming_at_evening,
            'request_id' => $request->id,
            'holidaytype' => $requests[0]->holidaytype,
            'latest_action' => 8,
            'statut' => 1,
            'admin_id' => $user->id,
        ]);
        DB::table('requests')->where('id', $request->id)->update(['archived' => 0]);

        $request_->save();

        return redirect()->route('requests')
                        ->with('success','Request unarchived successfully.');
    }
}
