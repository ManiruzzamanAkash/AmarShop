<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\District;
use App\Division;
use Image;
use Auth;
use File;

class DistrictController extends Controller
{

	function __construct(){
		$this->middleware('auth:admin');
	}

	public function index(){
		$divisions = Division::orderBy('name', 'asc')->get();
		$districts = District::orderBy('name', 'asc')->get();
		return view('admin.pages.district.index')->withDistricts($districts)->withDivisions($divisions);
	}
	
	public function edit($id){
		$district = District::find($id);
		$divisions = Division::orderBy('name', 'asc')->get();
		return view('admin.pages.district.edit')->withDistrict($district)->withDivisions($divisions);
	}


	public function store(Request $request){
		$this->validate($request, [
			'name' 			=> 'required',
			'division_id' 	=> 'required|integer',
			'image' 		=> 'nullable|image',
		]);

		DB::table('districts')->insert(
			[
				'name' 			=> $request->name,
				'division_id' 	=> $request->division_id,
				'image' 		=> $image,
			]
		);

    	//Image Manipulation With Intervention
		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$filename = $request->name. '.'.$image->getClientOriginalExtension();
			$location = public_path('images/districts/'.$filename);
            //Resize and upload
			Image::make($image)->save($location);
			$image = $filename;
		}else{
			$image = NULL;
		}



		$request->session()->flash('success', 'District has added successfully');
		return back();
	}

	public function update(Request $request, $id){
		$district = District::find($id);
		$this->validate($request, [
			'name' 			=> 'required',
			'division_id' 	=> 'required|integer',
			'image' 		=> 'nullable|image',
		]);

		DB::table('districts')
		->where('id', $id)
		->update(
			[
				'name' 			=> $request->name,
				'division_id' 	=> $request->division_id,
				'image' 		=> $image,
			]
		);

    	//Image Manipulation With Intervention
		if ($request->hasFile('image')) {

			//Rmove the old image
			if (File::exists("images/districts/$district->image")) {
				File::delete("images/districts/$district->image");
			}
			
			$image = $request->file('image');
			$filename = $request->name. '.'.$image->getClientOriginalExtension();
			$location = public_path('images/districts/'.$filename);
            //Resize and upload
			Image::make($image)->save($location);
			$image = $filename;
		}else{
			if (!File::exists("images/districts/$district->image")) {
				$image = NULL;
			}else {
				$image = $district->image;
			}
		}



		$request->session()->flash('success', 'District has Updated successfully');
		return redirect()->route('admin.district.index');
	}

	public function destroy(Request $request, $id){
		$district = District::find($id);

    	//delete the old file
		if (File::exists("images/districts/$district->image")) {
			File::delete("images/districts/$district->image");
		}

		$district->delete();
		$request->session()->flash('success', 'District has removed successfully');
		return back();
	}
}
