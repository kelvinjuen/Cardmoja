<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    public function redirectTo(){
        if(auth()->user()->type == 'personal'){
            if(auth()->user()->active == 0){
                return '/card/create';
            }else{
                return '/home';
            }

        }else if(auth()->user()->type =='coperate'){
            if(auth()->user()->active == 0){
                return '/coperate/create';
            }else{
                return '/coperate';
            }
            return '/coperate/create';
        }else if( auth()->user()->type == 'coperate_user'){
            if(auth()->user()->active == 0){
                return '/coperateuser/create';
            }else{
                return '/home';
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        session(['url.intended' => url()->previous()]);
        $this->redirectTo =session()->get('url.intended');
        $this->middleware('guest')->except('logout');
    }
}
