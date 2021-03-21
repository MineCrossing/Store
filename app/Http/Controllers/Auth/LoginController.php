<?php

namespace App\Http\Controllers\Auth;

use mbing\opensslCryptor\Cryptor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Laravel\Passport\Bridge\AccessToken;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

        /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());
        return view('auth.login');
    }

    /**
     * Override standard redirect to previous page prior to login in.
     * 
     * @return view
     */
    public function redirectTo() {
        // dd(session()->get('previousUrl'));
        // $accessToken = Auth::user()->createToken('authToken')->accessToken;
        // $id = $accessToken->token->id;
        $prev = $_SERVER['HTTP_REFERER'];
        if(!($prev->contains('minecrossing.xyz'))) {
            $prev = 'https://store.minecrossing.xyz';
        }
        
        return $prev;
        // $tokenObj = Auth::user()->createToken('authToken');
        // $token = $tokenObj->accessToken;
        // $token_id = $tokenObj->token->id;
        // Cookie::queue('loginAuth', '{"token": "'.$token_id.'","userId":"'.Auth::user()->id.'"}', 180, 'null', '.minecrossing.xyz');
        // return str_replace(url('/'), '', session()->get('previousUrl', '/')); 
    }

}
