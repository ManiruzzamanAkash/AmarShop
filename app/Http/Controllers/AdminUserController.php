<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BannedUser;
use Session;

class AdminUserController extends Controller
{
	function __construct(){
		$this->middleware('auth:admin');
	}

	public function index()
	{
		$users = User::orderBy('id', 'desc')->paginate(20);
		return view('admin.pages.manage_user')->with('users', $users);
	}
	function update_trust_point(Request $request, $id)
	{
    	// User::find($id)->first()->update([
    	// 	'trust_point'	=> $request->trust_point
    	// ]);
    	// dd($id);

		$user = User::findOrFail($id);
		$user->trust_point = $request->trust_point;
		$user->save();
		$request->session()->flash('success', 'User trust point has updated');
		return back();
	}

	function ban(Request $request, $id)
	{
		$user = User::find($id);

		//Find user in the banned user list
		$banned = BannedUser::where('user_id', $user->id)->orWhere('email', $user->email)->first();
		if ($banned != null) {
			//Delete
			$banned->delete($banned->id);
			$request->session()->flash('success', 'User has removed from banned user list successfully');
		}else{
			$ban = new BannedUser;
			$ban->user_id = $user->id;
			$ban->email = $user->email;
			$ban->reason = $request->reason;
			$ban->save();
			$request->session()->flash('success', 'User has banned for future');
		}
		return redirect()->route('admin.user');	
	}
}
