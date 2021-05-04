<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Procata;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
	public function __construct()
	{
		$brands = Catalog::Where('brand', 1)->get();
		view()->share('brands', $brands);
	}

	public function getIndex()
	{
		$tops = Product::orderBy('buyed', 'desc')->Limit(15)->paginate(6);
		$sales = Product::Where('discount', '!=', 0)->orderBy('discount', 'desc')->paginate(6);
		return view('page.home', compact('tops', 'sales'));
	}

	public function search(Request $request, $type = null, $id = null)
	{
		if ($type == 'catalog') {
			$catalog = Procata::Where('catalog_id', $id)->get('product_id');
			$products = Product::WhereIn('id', $catalog)->paginate(6);
		} elseif ($type == 'keyword') {
			$products = Product::where('name', 'like', '%' . $request->keyword . '%')->paginate(9);
		} elseif ($type == 'price') {
			if ($id == '1000000') {
				$products = Product::Where('price', '>=', $id)->orderBy('price', 'desc')->paginate(9);
			} elseif ($id == '500000') {
				$products = Product::Where([['price', '>=', $id], ['price', '<', 1000000]])->orderBy('price', 'desc')->paginate(9);
			} else {
				$products = Product::Where([['price', '>=', $id], ['price', '<', 500000]])->orderBy('price', 'desc')->paginate(9);
			}
		} elseif ($type == 'sale') {
			$products = Product::Where('discount', '!=', 0)->paginate(6);
		} elseif ($type == 'topsale') {
			$products = Product::Where('discount', '!=', 0)->orderBy('discount', 'desc')->paginate(6);
		} elseif ($type == 'top') {
			$products = Product::orderBy('buyed', 'desc')->Limit(18)->paginate(6);
		} elseif ($type == 'newest') {
			$products = Product::orderBy('created_at', 'desc')->paginate(6);
		} elseif ($type == 'desc') {
			$products = Product::orderBy('price', 'desc')->paginate(6);
		} elseif ($type == 'asc') {
			$products = Product::orderBy('price', 'asc')->paginate(6);
		} else {
			$products = Product::paginate(9);
		}
		return view('page.shop', compact('products'));
	}

	public function productDetail($id)
	{
		$product = Product::Where('id', $id)->first();
		$image_list = json_decode($product->image_list);
		$sizes = ProductSize::Where([['product_id', $id], ['quantity', '>', 0]])->get();
		$catalog = Procata::Where('product_id', $id)->get('catalog_id');
		$pro_ids = Procata::WhereIn('catalog_id', $catalog)->get('product_id');
		$products = Product::WhereIn('id', $pro_ids)->get();
		$contents = explode(";",$product->content);
		return view('page.product-detail', compact('product', 'image_list', 'sizes', 'products','contents'));
	}

	/*-- Checkout --*/
	public function checkout()
	{
		$products = Product::whereIn('id', array_keys(session('cart')))->get();
		$payments = Payment::get();
		return view('page.checkout', compact('payments', 'products'));
	}

	public function order(Request $request)
	{
		$name = $request->fullname;
		$mobile = $request->mobile;
		$email = $request->email;
		$check = Customer::where('phone',$mobile)->count();
		if ($check==0) {
			Customer::insert([
				'name' => $name,
				'phone' => $mobile,
				'email' => $email
			]);
			$customer = Customer::orderBy('id', 'desc')->first();
		} else {
			$customer = Customer::where('phone',$mobile)->first();
		}
		$customer_id = $customer->id;
		$address = $request->address;
		$payment_id = $request->payment;
		$total = $request->total;
		$note = $request->note;
		Order::insert([
			'customer_id' => $customer_id,
			'address_ship' => $address,
			'payment_id' => $payment_id,
			'total' => $total,
			'note' => $note
		]);
		$order = Order::orderBy('id', 'desc')->first();
		$order_id = $order->id;
		foreach (array_keys(session('cart')) as $product_id) :
			$quantity = session("cart.$product_id.number");
			$size = session("cart.$product_id.size");
			$product = Product::where('id', $product_id)->first();
			if ($product->discount == 0) :
				$price = $product->price;
			else :
				$price = $product->price*(100-$product->discount)*0.01;
			endif;
			$pro_size = ProductSize::where([['product_id',$product_id],['size',$size]])->first();
			$qty = $pro_size->quantity;
			$qtynew = $qty - $quantity;
			$buyed = $product->buyed + 1;
			OrderDetail::insert([
				'order_id' => $order_id,
				'product_id' => $product_id,
				'size'=>$size,
				'quantity' => $quantity,
				'price' => $price
			]);
			ProductSize::where([['product_id',$product_id],['size',$size]])->update(['quantity' => $qtynew]);
			Product::where('id',$product_id)->update(['buyed'=>$buyed]);
		endforeach;
		session()->forget("cart");
		return redirect('/')->with('alert', 'success');
	}

	public function getSearch(Request $request, $type = null)
	{
		if ($type=='search')
		{
			$phone = $request->phone;
			$customer = Customer::where('phone',$phone)->first();
			$orders = Order::where('customer_id',$customer->id)->get();
			if ($orders==null)
			{
				$alert='Số điện thoại này chưa mua hàng';
				return redirect()->back()->with('alert',$alert);
			} else {
				return view('page.follow-order',compact('orders','customer'));
			}
		}
		else
		{
			$orders = null;
			$customer = null;
			return view('page.follow-order',compact('orders','customer'));
		}
	}

	public function orderDetail($id)
	{
		$order=Order::where('id',$id)->first();
		$order_details=OrderDetail::where('order_id',$id)->get();
		return view('page.order-detail',compact('order','order_details'));
	}

	public function deleteOrder($id)
	{
		$orderDetailts = OrderDetail::Where('order_id',$id)->get();
		foreach ($orderDetailts as $odt):
			$product = Product::Where('id',$odt->product_id)->first();
			ProductSize::Where([['product_id',$odt->product_id],['size',$odt->size]])->update(['quantity'=>$product->quantity + $odt->quantity]);
		endforeach;
		OrderDetail::Where('order_id',$id)->delete();
		Order::Where('id',$id)->delete();
		return redirect()->back();
	}

	/*-- end Checkout --*/
}
