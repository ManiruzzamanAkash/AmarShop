<?php

namespace App\Http\Controllers;

use App\Featured;
use Illuminate\Http\Request;
use Session;

class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featureds = Featured::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.product.featured')->withFeatureds($featureds);
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
        $featured = new Featured;
        $featured->product_id = $request->product_id;
        $featured->status = 1; // 1means visible to products page
        $featured->save();
        $request->session('success', 'Product has added to featured product successfully !!');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Featured  $featured
     * @return \Illuminate\Http\Response
     */
    public function show(Featured $featured)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Featured  $featured
     * @return \Illuminate\Http\Response
     */
    public function edit(Featured $featured)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Featured  $featured
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Featured $featured)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Featured  $featured
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $featured = Featured::findOrFail($id);
        $featured->delete();
        Session::flash('success', 'Product has removed successfully from the featured list..');
        return redirect()->route('admin.product.featured');
    }
}
