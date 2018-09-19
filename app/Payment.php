<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    function payment_method()
    {
    	return $this->belongsTo(PaymentMethod::class);
    }
}
