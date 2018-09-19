<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use App\Wishlist;
use App\Notification;
use App\Product;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        //Send Notification to the user
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();

                foreach ($wishlists as $wishlist) {
                    $datetime1 = new \DateTime("now");
                    $datetime2 = new \DateTime($wishlist->product->offer_expiry_date);
                    

                    $interval = $datetime1->diff($datetime2);
                    $difference_sign = $interval->format('%R');
                    $difference = $interval->format('%a');
                    //echo $difference_sign;
                    //echo $difference;
                    if ($difference_sign == "+") {
                         // echo 'Enter + sign <br />';
                        if ($difference >= 0 && $difference <= 1) {

                        // echo 'Enter $difference >= 0 && $difference <= 1 condition <br />';
                            //check notification send or not
                            $res = Notification::where('user_id', Auth::user()->id)
                            ->where('wishlist_id', $wishlist->id)
                            ->where('product_id', $wishlist->product->id)
                            ->first();
                            // echo $res;
                            if ($res == null) {
                                $notification = new Notification();
                                $notification->wishlist_id = $wishlist->id;
                                $notification->product_id = $wishlist->product->id;
                                $notification->user_id = Auth::user()->id;
                                $notification->save();
                            }
                            
                        }
                    }
                    // echo $difference;
                    // echo '<br /> '. $difference_sign;
                    // if ($difference <= 1) {
                    //     echo 'Yes its time to send notification';
                    // }


                    // $today_time = strtotime(time());
                    // $wishlist_expiry_time = strtotime($wishlist->product->offer_expiry_date);

                    // echo $today_time->diff($wishlist_expiry_time) ;
                    //$today_time->diff($wishlist_expiry_time);

                }

            }
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //new ComposerServiceProvider();

    }
}
