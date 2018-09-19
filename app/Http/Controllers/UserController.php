<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Order;
use App\OrderItem;
use App\Payment;
use App\PaymentMethod;
use App\User;
use App\Trust;

use App\Product;
use App\ShippingAdress;
use App\Wishlist;
use App\Productrequest;
use App\Division;
use App\District;
use App\Category;
use App\Featured;
use App\Brand;
use App\Tag;
use Image;
use Auth;
use File;
use Session;


class UserController extends Controller
{

    function __construct(){

        $this->middleware('auth')->except(['show', 'verification']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function verification()
    {   
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     return view('users.verification')->withUser($user);
        // }

        // return view('users.verification');
        dd('Hei man');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (Auth::check()) {
            $trust = Trust::where('trustee_id', $user->id)->where('user_id', Auth::user()->id)->first();
            if ($trust != null) {
                $trust_or_not = true;
            }else {
                $trust_or_not = false;
            }
            return view('users.show')->withUser($user)->withTrust($trust_or_not);
        }else {
            return view('users.show')->withUser($user);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $divisions = Division::orderBy('name', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();

        $user = User::where('username', $username)->first();
        if ($user->id == Auth::user()->id) {
            return view('users.edit')->withUser($user)->withDivisions($divisions)->withDistricts($districts);
        }else {
            return redirect()->route('user.show', $user->username);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changeTrustStatus(Request $request){
        $this->validate($request, array(
            'trustee_id'    => 'required|integer'
        ));

        $trustee_id = $request->trustee_id;
        $user_id = Auth::id();
        $trust = Trust::where('trustee_id', $trustee_id)->where('user_id', $user_id)->first();
        $user = User::find($trustee_id);
        if ($trust != null) {
            //remove from trust + decrement 10 point from user ranking account
            $trust->delete();
            $user->trust_point = $user->trust_point - 10;
            $user->save();
        }else {
            //add in trust table + increment 10 in user account
            $trust = new Trust;
            $trust->trustee_id = $trustee_id;
            $trust->user_id = $user_id;
            $trust->save();

            //add 10 in user trust_point
            
            $user->trust_point = $user->trust_point + 10;
            $user->save();
        }
        return back();
    }

    public function changeProfilePicture(Request $request, $id){
        $this->validate($request, array(
            'image' => 'nullable|image'
        ));
        $user = User::find($id);
        if ($user->id == Auth::user()->id) {
            if ($request->hasFile('image')) {
                //Delete the previous user profile

                if (File::exists("images/users/$user->image")) {
                    File::delete("images/users/$user->image");
                }

                $img = $request->file('image');
                $image = $user->username.'.'.$img->getClientOriginalExtension();
                $location = public_path('images/users/'.$image);
                Image::make($img)->save($location);
                $user->image = $image;
                $user->save();
                $request->session()->flash('success', 'Profile picture has changed successfully');
                
            }
            return redirect()->route('user.show', $user->username);
            
        }else {
            $request->session()->flash('error', 'You have not access to change this profile picture');
            return redirect()->route('user.show', $user->username);
        }
        
    }
    // public function uploadProfilePicture(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'image' => 'required|image64:jpeg,jpg,png'
    //         ]);
    //     if ($validator->fails()) {
    //         return response()->json(['errors'=>$validator->errors()]);
    //     } else {
    //         $imageData = $request->get('image');
    //         $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
    //         Image::make($request->get('image'))->save(public_path('images/').$fileName);
    //         return response()->json(['error'=>false]);
    //     }
    // }


    public function dashboard()
    {
        return view('users.dashboard.index');
    }

    public function changeShippingAddress()
    {
        $divisions = Division::orderBy('order', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        $upazillas = DB::table('upazillas')->orderBy('name', 'asc')->get();
        $user = Auth::user();
        return view('users.dashboard.shipping_address')->withUser($user)->withDivisions($divisions)->withDistricts($districts)->withUpazillas($upazillas);
    }
    public function changeShippingAddressStore(Request $request)
    {
        $this->validate($request, array(
            'name'  => 'required'
        ));

        if (!empty($request->shipping_id)) {
            //That means Already entered that shipping Address > Update the address now
            $shipping_address = ShippingAdress::find($request->shipping_id);
            $shipping_address->name = $request->name;
            $shipping_address->email = $request->email;

            $shipping_address->user_id = Auth::id();

            $shipping_address->division_id = $request->division_id;
            $shipping_address->district_id = $request->district_id;
            $shipping_address->upazilla_id = $request->upazilla_id;
            $shipping_address->phone = $request->phone;
            $shipping_address->street_address1 = $request->street_address1;
            $shipping_address->street_address2 = $request->street_address2;
            $shipping_address->courier_address = $request->courier_address;
            $shipping_address->save();
            $request->session()->flash('success', 'Shipping address has updated ');
        }else{
            //Make a new shipping address and reurn the id
            $shipping_address = new ShippingAdress;
            $shipping_address->name = $request->name;
            $shipping_address->email = $request->email;
            $shipping_address->user_id = Auth::id();
            
            $shipping_address->division_id = $request->division_id;
            $shipping_address->district_id = $request->district_id;
            $shipping_address->upazilla_id = $request->upazilla_id;
            $shipping_address->phone = $request->phone;
            $shipping_address->street_address1 = $request->street_address1;
            $shipping_address->street_address2 = $request->street_address2;
            $shipping_address->courier_address = $request->courier_address;
            $shipping_address->save();
            $request->session()->flash('success', 'A new Shipping address has just created ');
        }
        return back();
    }
    public function updateProfile()
    {
        $divisions = Division::orderBy('order', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        $user = Auth::user();
        return view('users.dashboard.update_profile')->withUser($user)->withDivisions($divisions)->withDistricts($districts);
    }
    public function updateProfileStore(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image'
        ));

        $user->name = $request->name;
        $user->email = $request->email;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->is_company = $request->is_company;
        $user->street_address = $request->street_address;
        $user->website = $request->website;
        
        if ($request->hasFile('image')) {
                //Delete the previous user profile

            if (File::exists("images/users/$user->image")) {
                File::delete("images/users/$user->image");
            }

            $img = $request->file('image');
            $image = $user->username.'.'.$img->getClientOriginalExtension();
            $location = public_path('images/users/'.$image);
            Image::make($img)->save($location);
            $user->image = $image;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        $request->session()->flash('success', 'User informations has updated..');
        return back();
    }

    public function manageOrders()
    {
        $orders = DB::table('orders')
            // ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('shipping_adresses', 'orders.shipping_id', '=', 'shipping_adresses.id')
            ->where('is_completed_by_admin', 1)
            ->orderBy('orders.id', 'desc')
            ->paginate(3);
        return view('users.dashboard.manage_orders')->withOrders($orders);
    }

}
