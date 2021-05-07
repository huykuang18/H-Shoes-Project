<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
	public function __construct()
	{
		$brands = Brand::get();
		view()->share('brands', $brands);
	}
	/* -- Cart --*/
	public function cart(Request $request, $action = null, $id = null)
	{
		switch ($action) {
			case 'update':
				foreach (array_keys(session('cart')) as $key) {
					session([
						"cart.$key.number" => $request->input($key . "number")
					]);
				}
				return redirect("cart");
				break;

			case 'add':	
				if (session("cart.$id.number") && session("cart.$id.size") == $request->size) {	
					session(["cart.$id.number" => session("cart.$id.number") + $request->number]);
				} elseif (session("cart.$id.number") && session("cart.$id.size") != $request->size) {
					$newid = session_create_id("cart-$id");
					session_id($newid);
					session([
						"cart.$id.number" => $request->number,
						"cart.$id.size" => $request->size
					]);
				} else {	
					session([
						"cart.$id.number" => $request->number,
						"cart.$id.size" => $request->size
					]);
				}		
				return redirect('cart');
				break;

			case 'delete':
				session()->forget("cart.$id");
				return redirect('cart');
				break;
			case 'deleteall':
				session()->forget("cart");
				return redirect('cart');
				break;
			default:
				if (session("cart")) {
					$products = Product::whereIn('id', array_keys(session('cart')))->get();
					return view('page.cart', compact('products'));
				} else {
					return view('page.cart');
				}
				break;
		}
	}
	/*-- end cart --*/
}
