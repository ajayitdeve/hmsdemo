<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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
    //protected $redirectTo = RouteServiceProvider::HOME;
    // protected function redirectTo(){
    //     if(auth()->user()->hasRole('admin')){
    //         return redirect()->route('admin.dashboard');
    //         }else {
    //             return redirect()->route('user.dashboard');
    //          }
    // }
    protected function redirectTo()
    {

        return redirect()->route('admin.dashboard');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $login_type = filter_var($input['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'user_id';

        if (auth()->attempt(([$login_type => $input["username"], 'password' => $input['password']]))) {
            // if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.dashboard');
            // }else {
            //  return redirect()->route('user.dashboard');
            //}

        } else {
            return redirect()->route("login")->with("error", "incorrect username or password");
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
