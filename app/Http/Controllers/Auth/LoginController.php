<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\WareHouse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
//    protected $redirectTo = '/admin';
    public function redirectPath()
    {
        if(Auth::user()->hasRole('user')) {
            return '/';
        }
        else if(Auth::user()->hasRole('kho')) {
            return '/admin/dashboard';
        }
        else {
            return '/admin';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


}
