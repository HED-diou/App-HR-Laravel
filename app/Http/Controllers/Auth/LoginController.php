<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /* protected $redirectTo = RouteServiceProvider::HOME; */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    protected function redirectTo()
    {

        if(Auth::user()->connected_at == NULL && !Auth::user()->hasRole('admin'))
        {
            return '/user/change-password';
        }
        elseif( Auth::user()->hasRole('admin'))
        {
            $user = Auth::user();
            $user->connected_at = Carbon::now() ;
            $user->save();
            return '/admin';
        }

        else
        {
            $user = Auth::user();
            $user->connected_at = Carbon::now() ;
            $user->save();
            return '/user';
        }


    }
}
