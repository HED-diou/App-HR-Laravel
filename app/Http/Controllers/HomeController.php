<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cron;
use App\Models\Company;
use Facade\Ignition\DumpRecorder\Dump;
use App\Rules\isNotOldPassword;
use App\Rules\IsStrongPassword;
use App\Rules\isValidBirthDate;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
        {if(Auth::user()->admin){
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

        }else{

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
          }
}
