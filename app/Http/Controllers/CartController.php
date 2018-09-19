<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use Auth;
use Session;

class CartController extends Controller
{

    public function index()
    {
        $cart_items = Cart::content();
        return view('pages.product.cart')->with('cart_items', $cart_items);
    }

    public function create(Request $request, $id)
    {
        $qty = $request->qty;
        $product = Product::find($id);
        $image = DB::table('product_images')->where('product_id', $product->id)->first();
         Cart::add($product->id, $product->title, $qty, $product->price,  [ 'size' => ucfirst($product->size)]);

        //Cart::add(['id' => $product->id, 'name' => $product->title, 'qty' => 1, 'price' => $product->price, 'options' =>  ['size' => $product->size, 'slug', $product->slug]]);

        Session::flash('success', 'Product has added to the cart');
        return back();
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty'   => 'required|integer'
        ]);

        Cart::update($id, [
            'qty' => $request->qty,
            "options" => ['size' => $request->size]
        ]);
        Session::flash('success', 'Cart has updated');
        return back();
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        Session::flash('success', 'Cart item has removed');
        return back();
    }
}
