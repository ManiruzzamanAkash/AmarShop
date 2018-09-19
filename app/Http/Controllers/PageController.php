<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

use App\Product;
use App\Wishlist;
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

class PageController extends Controller
{

	function __construct(){

	}

	public function index(){
		

		//dd(Auth::user());
		$categories = Category::orderBy('name', 'ASC')->paginate(10);
		$brands = Brand::orderBy('name', 'ASC')->limit(8)->get();
		$divisions = Division::orderBy('name', 'ASC')->get();
		return view('pages.index')
		->withDivisions($divisions)
		->withCategories($categories)
		->withBrands($brands);
	}
	public function searchProduct(Request $request){
		$search = $request->search;
		if ($search == "") {
			$postproducts = Product::orderBy('id', 'desc')->paginate(20);
			$requestproducts = Productrequest::orderBy('id', 'desc')->paginate(20);

		}else{
			$postproducts = Product::orderBy('id', 'desc')
			->orWhere('title', 'like', '%'.$search.'%')
			->orWhere('description', 'like', '%'.$search.'%')
			->orWhere('price', 'like', '%'.$search.'%')
			->paginate(20);

			$requestproducts = Productrequest::orderBy('id', 'desc')
			->orWhere('title', 'like', '%'.$search.'%')
			->orWhere('description', 'like', '%'.$search.'%')
			->orWhere('price_range', 'like', '%'.$search.'%')
			->paginate(20);
		}
		return view('pages.product.search')->withPostproducts($postproducts)->withRequestproducts($requestproducts)->withSearch($search);
	}

	function search()
	{
		return view('pages.search');
	}

	function apiSearch(Request $request, $search)
	{
		$postproducts = Product::orderBy('id', 'desc')
		->orWhere('title', 'like', '%'.$search.'%')
		->orWhere('description', 'like', '%'.$search.'%')
		->orWhere('price', 'like', '%'.$search.'%')
		->get();
		return response()->json($postproducts);
		
	}


	public function divisions()
	{
		$divisions = Division::orderBy('id', 'asc')->get();
		return view('pages.product.division.main')->withDivisions($divisions);
	}

	public function categories()
	{
		$categories = Category::orderBy('name', 'asc')->get();
		return view('pages.product.category.main')->withCategories($categories);
	}

	public function brands()
	{
		$brands = Brand::orderBy('name', 'asc')->get();
		return view('pages.product.brand.main')->withBrands($brands);
	}

	public function division_product($slug="")
	{
		$division = Division::where('slug', $slug)->first();
		// if ($division->count() == 1) {
		$products = Product::orderBy('id', 'desc')
		->where('publish_status', 1)
		->where('division_id', $division->id)
		->paginate(10);
		return view('pages.product.division.index')->withProducts($products)->withDivision($division);
		// }else {
		// 	return redirect()->route('product.index');
		// }
	}

	public function category_product($slug="")
	{
		$category = Category::where('slug', $slug)->first();
		// if ($category->count() == 1) {
		$products = Product::orderBy('id', 'desc')
		->where('publish_status', 1)
		->where('category_id', $category->id)
		->paginate(10);
		return view('pages.product.category.index')->withProducts($products)->withCategory($category);
		// }else {
		// 	return redirect()->route('product.index');
		// }
	}

	public function brand_product($slug="")
	{
		$brand = Brand::where('slug', $slug)->first();
		// if ($brand->count() == 1) {
		$products = Product::orderBy('id', 'desc')
		->where('publish_status', 1)
		->where('brand_id', $brand->id)
		->paginate(10);
		return view('pages.product.brand.index')->withProducts($products)->withBrand($brand);
		// }else {
		// 	return redirect()->route('product.index');
		// }
	}

}
