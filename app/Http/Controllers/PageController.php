<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Procata;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
	public function __construct()
	{
		$brands = Brand::get();
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
			$products = Product::Where('catalog_id', $id)->paginate(6);
			$title = Catalog::where('id',$id)->first()->name;
		} elseif ($type == 'brand') {
			$products = Product::Where('brand_id', $id)->paginate(6);
			$title = Brand::where('id',$id)->first()->name;
		} elseif ($type == 'keyword') {
			$products = Product::where('name', 'like', '%' . $request->keyword . '%')->paginate(9);
			$title = 'keyword';
		} elseif ($type == 'price') {
			if ($id == '1000000') {
				$products = Product::Where('price', '>=', $id)->orderBy('price', 'desc')->paginate(9);
				$title = 'Sản phẩm trên 1 triệu';
			} elseif ($id == '500000') {
				$products = Product::Where([['price', '>=', $id], ['price', '<', 1000000]])->orderBy('price', 'desc')->paginate(9);
				$title = 'Sản phẩm từ 500 nghìn- 1 triệu';
			} else {
				$products = Product::Where([['price', '>=', $id], ['price', '<', 500000]])->orderBy('price', 'desc')->paginate(9);
				$title = 'Sản phẩm dưới 500 nghìn';
			}
		} elseif ($type == 'sale') {
			$products = Product::Where('discount', '!=', 0)->paginate(6);
			$title = 'Đang giảm giá';
		} elseif ($type == 'topsale') {
			$products = Product::Where('discount', '!=', 0)->orderBy('discount', 'desc')->paginate(6);
			$title = 'Giảm giá nhiều';
		} elseif ($type == 'top') {
			$products = Product::orderBy('buyed', 'desc')->Limit(18)->paginate(6);
			$title = 'Mua nhiều';
		} elseif ($type == 'newest') {
			$products = Product::orderBy('created_at', 'desc')->paginate(6);
			$title = 'Sản phẩm mới';
		} elseif ($type == 'desc') {
			$products = Product::orderBy('price', 'desc')->paginate(6);
			$title = 'Giá giảm dần';
		} elseif ($type == 'asc') {
			$products = Product::orderBy('price', 'asc')->paginate(6);
			$title = 'Giá tăng dần';
		} else {
			$products = Product::paginate(9);
			$title = 'Sản phẩm';
		}
		return view('page.shop', compact('products','title'));
	}

	public function productDetail($id)
	{
		$product = Product::Where('id', $id)->first();
		$image_list = json_decode($product->image_list);
		$sizes = ProductDetail::Where([['product_id', $id], ['quantity', '>', 0]])->get();
		$catalog = Product::Where('id', $id)->get('catalog_id');
		$brand = Product::Where('id', $id)->get('brand_id');
		$products = Product::WhereIn('catalog_id', $catalog)->orWhereIn('catalog_id', $catalog)->get();
		$contents = explode(";",$product->content);
		$rates = Rate::Where('product_id',$id)->get();
		return view('page.product-detail', compact('product', 'image_list', 'sizes', 'products','contents','rates'));
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
			$pro_size = ProductDetail::where([['product_id',$product_id],['size',$size]])->first();
			$qty = $pro_size->quantity;
			$qtynew = $qty - $quantity;
			$buyed = $product->buyed + $quantity;
			OrderDetail::insert([
				'order_id' => $order_id,
				'product_id' => $product_id,
				'size'=>$size,
				'quantity' => $quantity,
				'price' => $price
			]);
			ProductDetail::where([['product_id',$product_id],['size',$size]])->update(['quantity' => $qtynew]);
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
			ProductDetail::Where([['product_id',$odt->product_id],['size',$odt->size]])->update(['quantity'=>$product->quantity + $odt->quantity]);
		endforeach;
		OrderDetail::Where('order_id',$id)->delete();
		Order::Where('id',$id)->delete();
		return redirect()->back();
	}

	/*-- end Checkout --*/

	/*-- ratting--*/
	public function rate(Request $request, $id)
	{
		$star = $request->star;
		$name = $request->name;
		$phone = $request->phone;
		$comment = $request->comment;
		Rate::insert([
			'product_id' => $id,
			'name' => $name,
			'phone' => $phone,
			'star' => $star,
			'note' => $comment
		]);

		$avg = Rate::where('product_id',$id)->avg('star');
		Product::where('id',$id)->update([
			'star'=>$avg
		]);

		return redirect()->back();
	}
}
