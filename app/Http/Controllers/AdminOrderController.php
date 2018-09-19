<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Payment;
use App\Product;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Auth;

class AdminOrderController extends Controller
{

    function __construct(){
        $this->middleware('auth:admin');
    }


    public function order_incomplete()
    {

        $orders = Order::where('is_completed_by_admin', 0)->orderBy('id', 'desc')->paginate(20);

        return view('admin.pages.order.incomplete_orders')
        ->with('orders', $orders);
    }
    public function order_complete()
    {

        $orders = Order::where('is_completed_by_admin', 1)->orderBy('id', 'desc')->paginate(20);

        return view('admin.pages.order.complete_orders')
        ->with('orders', $orders);
    }

    public function deliver(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        if ($order->is_completed_by_admin) {
            $order->is_completed_by_admin = 0;
            $request->session()->flash('error', 'Your order confirmation has cancelled ...!!!');
        }else{
            $order->is_completed_by_admin = 1;
            $request->session()->flash('success', 'Ok !! Your order has delivered successfully to all companies');
        }
        $order->save();
        return back();
    }

    public function show($id)
    {
        $order = Order::find($id);
        // $order->is_seen = 1;
        // $order->save();
        

        return view('admin.pages.order.show')
        ->with('order', $order);
    }

    public function is_paid($id)
    {
        $order = Order::find($id);

        $payment = Payment::where('order_id', $id)->first();
        if ($payment->is_paid == 0) {
            $payment->is_paid = 1;
        }else{
            $payment->is_paid = 0;
        }
        
        $payment->save();

        return redirect()->route('admin.order.show', $id);
    }


    public function edit(Admin $admin)
    {
        //
    }


    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy(Admin $admin)
    {
        //
    }
}
