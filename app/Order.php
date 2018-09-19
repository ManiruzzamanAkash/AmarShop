<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function shipping()
    {
    	return $this->belongsTo(ShippingAdress::class);
    }

    public function payment()
    {
    	return $this->belongsTo(Payment::class);
    }

    public function order_items()
    {
    	return $this->hasMany(OrderItem::class);
    }
}
