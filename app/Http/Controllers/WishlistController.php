<?php

namespace App\Http\Controllers;

use App\Wishlist;
use App\Notification;
use App\Product;
use Illuminate\Http\Request;
use Auth;

class WishlistController extends Controller
{

  function __construct(){
    $this->middleware('auth');
  }


  /**
  * Display the Wish list products
  *
  * @return the all wishlist products of authenticated user
  */
  public function index()
  {
    $wishlists = Wishlist::where('user_id', Auth::user()->id)->paginate(10);
    return view('pages.product.wishlist.index')->withWishlists($wishlists);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $this->validate($request, array(
      'product_id'  => 'required',
      'user_id'  => 'required'
    ));

    $wishlist = Wishlist::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();
    if ($wishlist != null) {
      //Don't insert and remove from wishlist
      $wishlist->delete();

      //Search in notification table
      $notification = Notification::where('user_id', Auth::user()->id)->where('wishlist_id', $wishlist->id)->first();
      if ($notification != null) {
        $notification->delete();
      }
      

      $request->session()->flash('error', 'Product has has deleted from wishlist !!!');
    }else{
      $wishlist = new Wishlist;
      $wishlist->product_id = $request->product_id;
      $wishlist->user_id = $request->user_id;
      $wishlist->save();

      $request->session()->flash('success', 'Product has added to wish list successfully !!!');
    }

    return back();

  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Wishlist  $wishlist
  * @return \Illuminate\Http\Response
  */
  public function show(Wishlist $wishlist)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Wishlist  $wishlist
  * @return \Illuminate\Http\Response
  */
  public function edit(Wishlist $wishlist)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Wishlist  $wishlist
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Wishlist $wishlist)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Wishlist  $wishlist
  * @return \Illuminate\Http\Response
  */
  public function destroy(Wishlist $wishlist)
  {
    //
  }
}
