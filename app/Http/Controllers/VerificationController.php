<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\VerifyEmail;

use App\User;
use Auth;
use Session;

class VerificationController extends Controller
{

	function __construct(){
		$this->middleware('auth')->except(['show', 'verification', 'verificationToken']);
	}


	public function verification()
	{   
		if (Auth::check()) {
			$user = Auth::user();
			return view('users.verification')->withUser($user);
		}

		return view('users.verification');
        // dd('Hei man');

	}

	public function verificationToken($token){
		$user = User::where('token', $token)->first();
		if (!is_null($user)) {
			if ($user->is_verified == 1) {
				Session::flash('already_added', 'User has already verified !! Please Login');
			}else {
				$user->is_verified = 1;
				$user->token = null;
				$user->save();
				Session::flash('success', 'Account has verified successfully!!');
			}

		}else {
			Session::flash('error', 'Invalid Token !! Please verify with correct token. Click send verification link again ');
		}
		return view('users.verification_token')->withToken($token)->withUser($user);
	}


	public function sendVerification(Request $request){
		$this->validate($request, array(
			'email' => 'required|email'
		));

		$email = $request->email;
		$user = User::where('email', $email)->first();

		if (!is_null($user)) {
			Session::flash('success', 'A verification email has sent to your email account !! Please Verify that email.');
			$user->notify(new VerifyEmail($user));
		}else {
			Session::flash('error', 'There is no user has registered yet by this email address !!');
		}
		return back();


	}


}
