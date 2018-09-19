<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Division;
use App\District;
use App\Notifications\VerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Mail;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verification';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $divisions = Division::orderBy('name')->get();
        $districts = District::orderBy('name')->get();

        return view('auth.register')->withDivisions($divisions)->withDistricts($districts);
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'              => 'required|string|max:30',
            'email'             => 'required|string|email|max:50|unique:users',
            'is_company'        => 'required|integer',
            'division_id'       => 'required|integer',
            'district_id'       => 'required|integer',
            'phone'             => 'required|unique:users',
            'street_address'    => 'nullable|max:100',

            'password'          => 'required|string|min:6|confirmed',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'is_company'        => $data['is_company'],
            'division_id'       => $data['division_id'],
            'district_id'       => $data['district_id'],
            'phone'             => $data['phone'],
            'token'             => str_random(50),
            'street_address'    => $data['street_address'],
            'password'          => bcrypt($data['password']),
            'username'          => $this->createUserName($data['name']),
            ]);
        
        Session::flash('success', 'A verification email has sent to your email account !! Please Verify that email.');
        $user->notify(new VerifyEmail($user));
        return redirect()->route('verification')->withUser($user);

    }

    public function register(Request $request){
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'is_company'        => $request->is_company,
            'division_id'       => $request->division_id,
            'district_id'       => $request->district_id,
            'phone'             => $request->phone,
            'token'             => str_random(50),
            'street_address'    => $request->street_address,
            'password'          => bcrypt($request->password),
            'ip'                => $request->ip(),
            'username'          => $this->createUserName($request->name),
            ]);
        
        Session::flash('success', 'A verification email has sent to your email account !! Please Verify that email.');
        $user->notify(new VerifyEmail($user));
        return redirect()->route('verification')->withUser($user);
    }











    //For Generating Unique Username
    public function createUserName($name, $id = 0)
    {
        $userName = str_slug($name);
        $allUsernames = $this->getRelatedUsernames($userName, $id);
        if (! $allUsernames->contains('username', $userName)){
            return $userName;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newUserName = $userName.'-'.$i;
            if (! $allUsernames->contains('username', $newUserName)) {
                return $newUserName;
            }
        }
        throw new \Exception('Can not create a unique username');
    }

    protected function getRelatedUsernames($userName, $id = 0)
    {
        return User::select('username')->where('username', 'like', $userName.'%')
        ->where('id', '<>', $id)
        ->get();
    }



    
}
