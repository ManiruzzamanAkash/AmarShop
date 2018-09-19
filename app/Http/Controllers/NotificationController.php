<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Wishlist;
use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{


  function __construct()
  {
    $this->middleware('auth');
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seen_notification = Notification::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $unseen_notification = Notification::where('user_id', Auth::user()->id)->where('status', 0)->get();
        return view('pages.notification.index')->withSeen($seen_notification)->withUnseen($unseen_notification);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        $notification->status = 1;
        $notification->save();
        return view('pages.notification.show')->withNotification($notification);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
     $notification = Notification::find($id);
     $notification->delete();

     $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $notification->product_id)->where('id', $notification->wishlist_id)->first();
     if ($wishlist != null) 
     {
      $wishlist->delete();
  }
  $request->session()->flash('success', 'Notification has deleted !!');
  return redirect()->route('notification');
}
}
