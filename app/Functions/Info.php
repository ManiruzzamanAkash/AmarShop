<?php

/*
|--------------------------------------------------------------------------
| Helper Routes For Manilpulate any functions in every page
|--------------------------------------------------------------------------
|
|
*/


function get_product_slug($id)
{
	$product = \App\Product::find($id);
	return $product->slug;
}

function get_product_first_image($id)
{
	$product = \App\Product::find($id);
	$image = DB::table('product_images')->where('product_id', $product->id)->first();
	return $image->image;
}

function get_user_or_company($product_id)
{
	$product = \App\Product::find($product_id);
	$user = \App\User::find($product->user_id);
	return $user;
}

?>