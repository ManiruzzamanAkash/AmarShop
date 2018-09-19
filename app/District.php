<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

	protected $fillable = [
	'name', 'district_id', 'image',
	];


	public function division(){
		return $this->belongsTo('App\Division');
	}
}
