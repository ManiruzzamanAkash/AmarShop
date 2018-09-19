<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'division_id', 'district_id', 'phone', 'description', 'is_verified', 'is_admin', 'status', 'ip', 'latitude', 'langitude', 'rating_id', 'street_address', 'website', 'is_company', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function division(){
        return $this->belongsTo('App\Division');
    }

    public function district(){
        return $this->belongsTo('App\District');
    }
    
    public function products(){
      return $this->hasMany('App\Product');
  }


  public function payout(){
    return $this->belongsTo(Payout::class);
}
public function shipping_address(){
    return $this->hasOne(ShippingAdress::class);
}

public function ban(){
    return $this->belongsTo(BannedUser::class);
}




    /**
     * Verified function
     *
     * @return boolean retun true if user is verified false otherwise
     */
    public function verified(){
        if ($this->is_verified == 0) {
            return false;
        }else {
            return true;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\UserResetPasswordNotification($token));
    }

}
