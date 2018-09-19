<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Division;
use App\District;
use App\Order;
use App\OrderItem;
use App\Payment;
use App\PaymentMethod;
use App\ShippingAdress;
use Illuminate\Http\Request;
// use Request;
use Auth;
use Session;

class OrderController extends Controller
{

    public function checkout(Request $request)
    {
        $divisions = Division::orderBy('order', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
        $upazillas = DB::table('upazillas')->orderBy('name', 'asc')->get();
        $payment_methods = PaymentMethod::orderBy('name', 'asc')->get();

        // dd();
        $shipping_address = [];
        if (Auth::check()) {
            $shipping_address = ShippingAdress::where('user_id', Auth::id())->first();
        }else{
            // get the ip of the user
            $user_ip = $request->ip();
            $shipping_address = ShippingAdress::where('ip', $user_ip)->first();
            if (count($shipping_address) > 0) {
                $shipping_address = $shipping_address;
            }else{
                $shipping_address = [];
            }

        }
        return view('pages.orders.checkout')->with('shipping_address', $shipping_address)->withDivisions($divisions)->withDistricts($districts)->withUpazillas($upazillas)->with('payment_methods', $payment_methods);
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
        //dd($request->shipping_id);
        $this->validate($request, array(
            'name'  => 'required'
        ));

        //First Step - Finish Up Order Informations and items

        //Save Shipping > Save Product > Make Order > Then Add Order Items
        if (!empty($request->shipping_id)) {
            //That means Already entered that shipping Address > Update the address now
            $shipping_address = ShippingAdress::find($request->shipping_id);
            $shipping_address->name = $request->name;
            $shipping_address->email = $request->email;

            if (Auth::check()) {
                $shipping_address->user_id = Auth::id();
            }else{
                $shipping_address->ip = $request::ip();
            }
            
            $shipping_address->division_id = $request->division_id;
            $shipping_address->district_id = $request->district_id;
            $shipping_address->upazilla_id = $request->upazilla_id;
            $shipping_address->phone = $request->phone;
            $shipping_address->street_address1 = $request->street_address1;
            $shipping_address->street_address2 = $request->street_address2;
            $shipping_address->courier_address = $request->courier_address;
            $shipping_address->save();

            $shipping_id = $shipping_address->id;
        }else{
            //Make a new shipping address and reurn the id
            $shipping_address = new ShippingAdress;
            $shipping_address->name = $request->name;
            $shipping_address->email = $request->email;

            if (Auth::check()) {
                $shipping_address->user_id = Auth::id();
            }else{
                $shipping_address->ip = $request::ip();
            }
            
            $shipping_address->division_id = $request->division_id;
            $shipping_address->district_id = $request->district_id;
            $shipping_address->upazilla_id = $request->upazilla_id;
            $shipping_address->phone = $request->phone;
            $shipping_address->street_address1 = $request->street_address1;
            $shipping_address->street_address2 = $request->street_address2;
            $shipping_address->courier_address = $request->courier_address;
            $shipping_address->save();

            $shipping_id = $shipping_address->id;
        }

        //Make Payment and get the $payment_id

        $tableStatus = DB::select("SHOW TABLE STATUS FROM amar_shop_laravel where Name = 'orders'");
        if (!empty($tableStatus)) {
            $order_id = $tableStatus[0]->Auto_increment;
        }else{
             $order_id = 0;
        }

        $payment = new Payment;
        $payment->order_id = $order_id;
        $payment->payment_method_id = $request->payment_method_id;
        $payment->payment_transaction = $request->payment_transaction;
        $payment->payment_informations = $request->payment_informations;
        $payment->save();

        $payment_id = $payment->id;

        //Make Order and Get Order_id
        $order = new Order;
        $order->shipping_id = $shipping_id;
        $order->payment_id = $payment_id;
        $order->order_message = $request->order_message;
        $order->save();

        foreach (Cart::content() as $row) {
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->product_id = $row->id;
            $order_item->item_quantity = $row->qty;
            $order_item->save();
        }



        $request->session()->flash('success', 'Your Order Has Successfully Stored.. !! Wait some times admin will see and you will get a new email about your transactions.');
        return redirect()->route('index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
