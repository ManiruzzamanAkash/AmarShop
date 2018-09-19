<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Wishlist;
use App\User;
use App\Trust;
use App\Productrequest;
use App\Division;
use App\District;
use App\Category;
use App\Featured;
use App\Brand;
use App\Tag;
use Image;
use Auth;
use File;
use Session;


class ProductController extends Controller
{

  function __construct(){
    $this->middleware('auth')->except(['show', 'index', 'request_products', 'request_products_show', 'changeProductStatus']);
  }

  public function index()
  {
    $products = Product::orderBy('id', 'desc')->where('publish_status', 1)->paginate(5);
    return view('pages.product.index')->withProducts($products);
  }

  public function request_products()
  {
    $products = Productrequest::orderBy('id', 'desc')->where('publish_status', 1)->paginate(10);
    return view('pages.product.request-products')->withProducts($products);
  }


  public function create()
  {
    $featureds = Featured::orderBy('id', 'asc')->where('status', 1)->limit(3)->get();

    $divisions = Division::orderBy('name', 'asc')->get();
    $districts = District::orderBy('name', 'asc')->get();
    $categories = Category::orderBy('name', 'asc')->get();
    $tags = Category::orderBy('name', 'asc')->get();
    $brands = Brand::orderBy('name', 'asc')->get();
    return view('pages.product.create')->withCategories($categories)->withDivisions($divisions)->withDistricts($districts)->withBrands($brands)->withFeatureds($featureds);
  }

  public function request()
  {
    $featureds = Featured::orderBy('id', 'asc')->where('status', 1)->limit(3)->get();

    $divisions = Division::orderBy('name', 'asc')->get();
    $districts = District::orderBy('name', 'asc')->get();
    $categories = Category::orderBy('name', 'asc')->get();
    $tags = Tag::orderBy('name', 'asc')->get();
    $brands = Brand::orderBy('name', 'asc')->get();
    return view('pages.product.request')->withCategories($categories)->withDivisions($divisions)->withDistricts($districts)->withBrands($brands)->withFeatureds($featureds);
  }


  public function store(Request $request)
  {
    $this->validate($request, [
      'title'         => 'required|max:150|min:5',
      'price'         => 'required|integer|min:1',
      'division'      => 'required|integer',
      'district'      => 'required|integer',
      'brand'         => 'nullable|integer',
      'size'          => 'required',
      'status'        => 'required|integer',
      'description'   => 'required|min:5',
      'phone'         => 'required|max:15',
      'image1'        => 'required|image',
    ]);

    $product = new Product;
    $product->title = $request->title;
    $product->price = $request->price;
    $product->division_id = $request->division;
    $product->district_id = $request->district;
    $product->category_id = $request->category;
    $product->brand_id = $request->brand;
    $product->phone = $request->phone;
    $product->size = $request->size;
    $product->status = $request->status;
    $product->description = $request->description;

    //Make a unique product slug
    //$product->slug = str_slug($product->title, '-');
    $product->slug = $this->createSlug($request->title, 0, true);

    if (Auth::guard('web')) {
      $product->user_id   = Auth::user()->id;
    }else {
      $product->company_id   = Auth::user()->id;
    }

    if ($request->offer_price || $request->offer_expiry_date) {
      $this->validate($request, [
        'offer_price'         => 'required|integer',
        'offer_expiry_date'   => 'required|max:20',
        'offer_message'       => 'nullable|max:100',
      ]);
      $product->offer_price = $request->offer_price;
      $product->offer_expiry_date = $request->offer_expiry_date.' 23:59:59';
      //2017-12-08 23:59:59
      $time = strtotime($product->offer_expiry_date);
      $newformat = date('Y-m-d H:i:s ',$time);
      $product->offer_expiry_date = $newformat;
      $product->offer_message = $request->offer_message;
    }

    $product->save();
    //Upload images to other product_images table

    if (($request->hasFile('image1')) || ($request->hasFile('image2')) || ($request->hasFile('image3'))) {

      if ($request->hasFile('image1')) {
        $img = $request->file('image1');
        $image1 = '1-'.time().'.'.$img->getClientOriginalExtension();
        $location = public_path('images/products/'.$image1);
        Image::make($img)->save($location);
        DB::table('product_images')->insert([
          'product_id' => $product->id,
          'image' => $image1
        ]);

      }

      if ($request->hasFile('image2')) {
        $img = $request->file('image2');
        $image2 = '2-'.time().'.'.$img->getClientOriginalExtension();
        $location = public_path('images/products/'.$image2);
        Image::make($img)->save($location);

        DB::table('product_images')->insert([
          'product_id' => $product->id,
          'image' => $image2
        ]);
      }

      if ($request->hasFile('image3')) {
        $img = $request->file('image3');
        $image3 = '3-'.time().'.'.$img->getClientOriginalExtension();
        $location = public_path('images/products/'.$image3);
        Image::make($img)->save($location);

        DB::table('product_images')->insert([
          'product_id' => $product->id,
          'image' => $image3
        ]);
      }

    }


    if ((Auth::user()->trust_point >= 100)) { //This is a verified customer who is trusted by 10 customers
      $product->publish_status = 1;
      $request->session()->flash('success', 'Your Product has added successfully');
    }else {
      $request->session()->flash('success', 'Your Product has added successfully and waiting for admin approval.');
    }

    


    return redirect()->route('product.index');
  }

  public function request_store(Request $request)
  {
    $this->validate($request, [
      'title'         => 'required|max:150|min:5',
      'price_range'   => 'required|min:1|max:20',
      'division'      => 'required|integer',
      'district'      => 'required|integer',
      'brand'         => 'nullable|integer',
      'size'          => 'required',
      'description'   => 'required|min:5',
      'phone'         => 'required|max:15',
      'image1'        => 'nullable|image',
    ]);

    $product = new Productrequest;
    $product->title = $request->title;
    $product->price_range = $request->price_range;
    $product->division_id = $request->division;
    $product->district_id = $request->district;
    $product->category_id = $request->category;
    $product->brand_id = $request->brand;
    $product->phone = $request->phone;
    $product->size = $request->size;
    $product->description = $request->description;

    //Make a unique product slug
    $product->slug = $this->createSlug($request->title, 0, false);

    if (Auth::guard('web')) {
      $product->user_id   = Auth::user()->id;
    }else {
      $product->company_id   = Auth::user()->id;
    }

    if ($request->hasFile('image1')) {
      $img = $request->file('image1');
      $image1 = '1-'.time().'.'.$img->getClientOriginalExtension();
      $location = public_path('images/product_requests/'.$image1);
      Image::make($img)->save($location);
      $product->image = $image1;
    }

    $product->save();

    $request->session()->flash('success', 'Your Product request has added successfully and waiting for admin approval.');
    return redirect()->route('product.request');
  }


  public function show($slug)
  {
    $product = Product::where('slug', $slug)->first();
    $category_id = $product->category_id;
    $similar_products = Product::where('category_id', $category_id)
    ->where('publish_status', 1)
    ->where('id', '!=', $product->id)
    ->limit(4)
    ->get();


    if (Auth::check()) {

      $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
      
      if ($product) {
        return view('pages.product.show')->withProduct($product)->with('similar_products', $similar_products)->withWishlist($wishlist);
      }else {
        return redirect()->route('product.index');
      }
    }else {
      if ($product) {
        $wishlist = null;
        return view('pages.product.show')->withProduct($product)->with('similar_products', $similar_products)->withWishlist($wishlist);
      }else {
        return redirect()->route('product.index');
      }
    }

  }

  public function request_products_show($slug)
  {
    $product = Productrequest::where('slug', $slug)->first();
    if ($product) {
      return view('pages.product.request_products_show')->withProduct($product);
    }else {
      return redirect()->route('product.request_products');
    }
  }

  public function changeProductStatus($id, $post=true)
  {
    if ($post) {
      $product = Product::find($id);
      $publish_status = $product->publish_status;
      if ($publish_status == 1) {
        $product->publish_status = 0;
        $message = 'Product has unpublished. To view the product please change its status';
      }else {
        $product->publish_status = 1;
        $message = 'Product has published successfully. It is now available in the products page';
      }
      $product->save();
      Session::flash('success', $message);
      return back();
    }else {
      $product = Productrequest::find($id);
      $publish_status = $product->publish_status;

      if ($publish_status == 1) {
        $product->publish_status = 0;
      }else {
        $product->publish_status = 1;
      }
      $product->save();
      Session::flash('success', 'Product status has changed successfully');
      return back();
    }

  }



  public function edit($id)
  {
    $product = Product::find($id);
    $featureds = Featured::orderBy('id', 'asc')->where('status', 1)->limit(3)->get();

    $divisions = Division::orderBy('name', 'asc')->get();
    $districts = District::orderBy('name', 'asc')->get();
    $categories = Category::orderBy('name', 'asc')->get();
    $tags = Category::orderBy('name', 'asc')->get();
    $brands = Brand::orderBy('name', 'asc')->get();

    return view('pages.product.edit')->withProduct($product)->withCategories($categories)->withDivisions($divisions)->withDistricts($districts)->withBrands($brands)->withFeatureds($featureds);
  }


  public function update(Request $request, Product $product)
  {
    //
  }


  public function destroy(Product $product)
  {
    //
  }



  //For Generating Unique Slug
  public function createSlug($title, $id = 0, $forpost = true)
  {
    // Normalize the title
    $slug = str_slug($title);
    // Get any that could possibly be related.
    // This cuts the queries down by doing it once.
    $allSlugs = $this->getRelatedSlugs($slug, $id, $forpost);
    // If we haven't used it before then we are all good.
    if (! $allSlugs->contains('slug', $slug)){
      return $slug;
    }
    // Just append numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
      $newSlug = $slug.'-'.$i;
      if (! $allSlugs->contains('slug', $newSlug)) {
        return $newSlug;
      }
    }
    throw new \Exception('Can not create a unique slug');
  }

  protected function getRelatedSlugs($slug, $id = 0, $forpost)
  {
    if ($forpost) {
      return Product::select('slug')->where('slug', 'like', $slug.'%')
      ->where('id', '<>', $id)
      ->get();
    }else {
      return Productrequest::select('slug')->where('slug', 'like', $slug.'%')
      ->where('id', '<>', $id)
      ->get();
    }

  }





  /**
  * Admin Product Pages
  */
  public function products_admin(){
    $products = Product::orderBy('id', 'desc')->paginate(10);
    return view('admin.pages.product.index')->withProducts($products);
  }







}
