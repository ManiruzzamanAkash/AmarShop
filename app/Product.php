<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function division(){
		return $this->hasOne('App\Division');
	}

	public function district(){
		return $this->hasOne('App\District');
	}

	public function category(){
		return $this->belongsTo('App\Category');
	}

	public function brand(){
		return $this->belongsTo('App\Brand');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}
}
