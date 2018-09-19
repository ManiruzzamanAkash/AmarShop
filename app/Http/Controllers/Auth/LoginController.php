<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;
use App\BannedUser;

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
    protected $redirectTo = '/';

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
     * Login Function [modified to check if user is verified or not]
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     Response 
     */
    public function login(Request $request){

    //Validate the form data
       $this->validate($request, [
        'email'         => 'email|required',
        'password'      => 'required|min:6'
    ]);

       $user = User::where('email', $request->email)->first();
       if ($user) {
        if ($user->is_verified == 0) {
            Session::flash('error', "You haven't verify your email account. Please Verify Your Email account !! A verification email has sent to your email");
            $user->notify(new VerifyEmail($user));
            //return redirect()->route('verification')->withUser($user);
        }else {
            $banned = BannedUser::where('email', $user->email)->first();
            if (!is_null($banned)) {
                Session::flash('error', "You are banned !!! Please contact to admin..");
                return redirect()->intended(route('index'));
            }

            //Attempt to log the user in
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                //If successful then redirect to the intended location
                return redirect()->intended(route('index'));

            }else{
                Session::flash('error', "Username and password combination doesn't match");
            }
        }
    }else {
        Session::flash('error', "There is no user account by this email address!!");
    }


        //If unsuccessfull, then redirect to the admin login with the data
    
    return redirect()->intended(route('index'));
}


}
