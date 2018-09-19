<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Image;
use File;
use Session;

class CategoryController extends Controller
{

  function __construct(){
    $this->middleware('auth:admin');
  }


  public function index()
  {
    $categories = Category::orderBy('name', 'asc')->paginate(20);
    return view('admin.pages.category.index')->withCategories($categories);
  }


  public function create()
  {
    $categories = Category::orderBy('name', 'asc')->paginate(20);
    return view('admin.pages.category.create')->withCategories($categories);
  }


  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|max:50|unique:categories',
      'description' => 'nullable|max:150',
      'image' => 'nullable|image',
      'parent_id' => 'nullable|integer'
    ]);

    $category = new Category;
    $category->name = $request->name;
    $category->slug = str_slug($category->name, '-');
    $category->description = $request->description;
    $category->parent_id = $request->parent_id;

    if ($this->checkCategorySlug( $category->slug)) {
      $category->slug = $category->slug .'-'.$category->id;
    }

    //Image Manipulation With Intervention
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = $category->slug. '.'.$image->getClientOriginalExtension();
      $location = public_path('images/categories/'.$filename);
      //Resize and upload
      Image::make($image)->resize(400, 400)->save($location);
      $category->image = $filename;
    }

    $category->save();

    $request->session()->flash('success', 'Category has added successfully!!');
    return redirect()->route('admin.category.index');
  }

  public function edit($id)
  {
    $allcategories = Category::orderBy('name', 'asc')->paginate(20);
    $category = Category::find($id);
    return view('admin.pages.category.edit')->withAllcategories($allcategories)->withCategory($category);
  }


  public function update(Request $request, $id)
  {
    $category = Category::find($id);

    $this->validate($request, [
      'name' => 'required|max:50|unique:categories,name,' .$category->id,
      'description' => 'nullable|max:150',
      'image' => 'nullable|image',
      'parent_id' => 'nullable|integer'
    ]);


    $category->name = $request->name;
    $category->slug = str_slug($category->name, '-');
    $category->description = $request->description;
    $category->parent_id = $request->parent_id;

    if ($this->checkCategorySlug( $category->slug)) {
      $category->slug = $category->slug .'-'.$category->id;
    }

    //Image Manipulation With Intervention
    if ($request->hasFile('image')) {

      //delete the old file
      if (File::exists("images/categories/$category->image")) {
        File::delete("images/categories/$category->image");
      }

      $image = $request->file('image');
      $filename = $category->slug. '.'.$image->getClientOriginalExtension();
      $location = public_path('images/categories/'.$filename);

      //Resize and upload
      Image::make($image)->resize(400, 400)->save($location);
      $category->image = $filename;
    }

    $category->save();

    $request->session()->flash('success', 'Category has updated successfully!!');
    return redirect()->route('admin.category.index');

  }


  public function destroy(Request $request, $id)
  {
    $category = Category::find($id);

    //delete the old images for this category
    if (File::exists("images/categories/$category->image")) {
      File::delete("images/categories/$category->image");
    }

    $category->delete();
    return 'deleted';
    // $request->session()->flash('success', 'Category has removed successfully');
    // return redirect()->route('admin.category.index');
  }

  public function checkCategorySlug($slug=""){
    $category = Category::where('slug', $slug)->first();
    if ($category) {
      return true;
    }else {
      return false;
    }
  }

}
