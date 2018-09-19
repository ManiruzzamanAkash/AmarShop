<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Product;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{

    function __construct(){
        $this->middleware('auth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unpublished_prodcuts = Product::where('publish_status', 0)->get();
        $published_prodcuts = Product::where('publish_status', 1)->get();
        $users = User::where('is_company', 0)->get();
        $companies = User::where('is_company', 1)->get();
        $order_complete = Order::where('is_completed_by_admin', 1)->get();
        $order_uncomplete = Order::where('is_completed_by_admin', 0)->get();

        return view('admin.pages.index')
                ->with('unpublished_products', $unpublished_prodcuts)
                ->with('published_products', $published_prodcuts)
                ->with('users', $users)
                ->with('companies', $companies)
                ->with('order_complete', $order_complete)
                ->with('order_uncomplete', $order_uncomplete);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }


    


}
