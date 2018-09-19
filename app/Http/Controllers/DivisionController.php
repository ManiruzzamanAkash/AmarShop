<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\District;
use App\Division;
use Image;
use Auth;
use File;

class DivisionController extends Controller
{

    function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $divisions = Division::orderBy('name', 'asc')->get();
        return view('admin.pages.divisions.index')->withDivisions($divisions);
    }
    
    public function edit($id){
        $division = Division::find($id);
        return view('admin.pages.divisions.edit')->withDivision($division);
    }


    public function store(Request $request){
        $this->validate($request, [
            'name'          => 'required',
            'image'         => 'nullable|image',
        ]);

        $slug = str_slug($request->name, '-');
        DB::table('divisions')->insert(
            [
                'name'      => $request->name,
                'slug'      => $slug,
                'image'     => $image,
            ]
        );


        //Image Manipulation With Intervention
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $slug. '.'.$image->getClientOriginalExtension();
            $location = public_path('images/divisions/'.$filename);
            //Resize and upload
            Image::make($image)->save($location);
            $image = $filename;
        }else{
            $image = NULL;
        }


        $request->session()->flash('success', 'Division has added successfully');
        return back();
    }

    public function update(Request $request, $id){
        $division = Division::find($id);
        $slug = str_slug($request->name, '-');
        $this->validate($request, [
            'name'          => 'required',
            'image'         => 'nullable|image',
        ]);

        //Image Manipulation With Intervention
        if ($request->hasFile('image')) {

            //Rmove the old image
            if (File::exists("images/divisions/$division->image")) {
                File::delete("images/divisions/$division->image");
            }
            
            $image = $request->file('image');
            $filename = $slug. '.'.$image->getClientOriginalExtension();
            $location = public_path('images/divisions/'.$filename);
            //Resize and upload
            Image::make($image)->save($location);
            $image = $filename;
        }else{
            if (!File::exists("images/divisions/$division->image")) {
                $image = NULL;
            }else {
                $image = $division->image;
            }
        }

        DB::table('divisions')
        ->where('id', $id)
        ->update(
            [
                'name'          => $request->name,
                'image'         => $image,
            ]
        );

        $request->session()->flash('success', 'Division has Updated successfully');
        return redirect()->route('admin.division.index');
    }

    public function destroy(Request $request, $id){
        $division = Division::find($id);

        //delete the old file
        if (File::exists("images/divisions/$division->image")) {
            File::delete("images/divisions/$division->image");
        }

        $division->delete();
        $request->session()->flash('success', 'Division has removed successfully');
        return back();
    }
}
