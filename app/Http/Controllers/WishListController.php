<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;

class WishListController extends Controller
{
	public function __construct()
	{
		$brands = Brand::get();
		view()->share('brands', $brands);
	}
	/* -- wish --*/
	public function wish(Request $request, $action = null, $id = null)
	{
		switch ($action) {
			case 'add':
				session([
					"wish.$id.number" => 1
				]);
				return redirect('wish');
				break;

			case 'delete':
				session()->forget("wish.$id");
				return redirect('wish');
				break;
			default:
				if (session("wish")) {
					$products = Product::whereIn('id', array_keys(session('wish')))->paginate(6);
					return view('page.wish', compact('products'));
				} else {
					return view('page.wish');
				}
				break;
		}
	}
	/*-- end wish --*/
}
