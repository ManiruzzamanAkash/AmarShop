<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

use Image;
use File;
use Session;

class BrandController extends Controller
{
  function __construct(){
    $this->middleware('auth:admin');
  }

  public function index()
  {
    $brands = Brand::orderBy('name', 'asc')->paginate(20);
    return view('admin.pages.brand.index')->withBrands($brands);
  }

  public function create()
  {
    return view('admin.pages.brand.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|max:50|unique:brands',
      'description' => 'nullable|max:150',
      'image' => 'nullable|image',
      'parent_id' => 'nullable|integer'
    ]);

    $brand = new Brand;
    $brand->name = $request->name;
    $brand->slug = str_slug($brand->name, '-');
    $brand->description = $request->description;

    if ($this->checkBrandSlug($brand->slug)) {
      $brand->slug = $brand->slug .'-'.$brand->id;
    }

    //Image Manipulation With Intervention
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = $brand->slug. '.'.$image->getClientOriginalExtension();
      $location = public_path('images/brands/'.$filename);
      //Resize and upload
      Image::make($image)->resize(400, 400)->save($location);
      $brand->image = $filename;
    }

    $brand->save();

    $request->session()->flash('success', 'Brand has added successfully!!');
    return redirect()->route('admin.brand.index');
  }

  public function edit($id)
  {
    $brand = Brand::find($id);
    return view('admin.pages.brand.edit')->withBrand($brand);
  }


  public function update(Request $request, $id)
  {
    $brand = Brand::find($id);

    $this->validate($request, [
      'name' => 'required|max:50|unique:brands,name,' .$brand->id,
      'description' => 'nullable|max:150',
      'image' => 'nullable|image',
    ]);


    $brand->name = $request->name;
    $brand->slug = str_slug($brand->name, '-');
    $brand->description = $request->description;

    if ($this->checkBrandSlug( $brand->slug)) {
      $brand->slug = $brand->slug .'-'.$brand->id;
    }

    //Image Manipulation With Intervention
    if ($request->hasFile('image')) {

      //delete the old file
      if (File::exists("images/brands/$brand->image")) {
        File::delete("images/brands/$brand->image");
      }

      $image = $request->file('image');
      $filename = $brand->slug. '.'.$image->getClientOriginalExtension();
      $location = public_path('images/brands/'.$filename);

      //Resize and upload
      Image::make($image)->resize(400, 400)->save($location);
      $brand->image = $filename;
    }

    $brand->save();

    $request->session()->flash('success', 'Brand has updated successfully!!');
    return redirect()->route('admin.brand.index');

  }

  /**
  * Delete Brand by ID.
  * @param $id - Brand ID
  * @return json-Response
  */
  public function destroy(Request $request, $id)
  {
    $brand = Brand::find($id);

    //delete the old images for this Brand
    if (File::exists("images/brands/$brand->image")) {
      File::delete("images/brands/$brand->image");
    }

    $brand->delete();
    return 'deleted';
    // $request->session()->flash('success', 'Brand has removed successfully');
    // return redirect()->route('admin.brand.index');
  }

  public function checkBrandSlug($slug=""){
    $brand = Brand::where('slug', $slug)->first();
    if ($brand) {
      return true;
    }else {
      return false;
    }
  }

}
