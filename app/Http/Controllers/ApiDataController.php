<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDataController extends Controller
{

    function get_districts($division_id)
    {
    	$districts = \App\District::where('division_id', $division_id)->get();
    	return json_encode($districts);
    }
    function get_upazillas($district_id)
    {
    	$upazillas = DB::table('upazillas')->where('district_id', $district_id)->get();
    	return json_encode($upazillas);
    }
}
