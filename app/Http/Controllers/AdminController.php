<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Rate;
use App\Models\Sale;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**Register */

    public function register()
    {
        return view('admin.register');
    }

    public function createAccount(Request $request)
    {
        $fullname = $request->fullname;
        $phone = $request->phone;
        $username = $request->username;
        $password = $request->password;
        $repassword = $request->repassword;
        $checkacc = Admin::Where('username',$username)->count();
        if($checkacc != 0){
            $alert = 'Tài khoản đã tồn tại, vui lòng nhập lại';
            return redirect()->back()->with('alert',$alert);
        } elseif($password != $repassword) {
            $alert = 'Mật khẩu không khớp, vui lòng nhập lại';
            return redirect()->back()->with('alert',$alert);
        } else {
            Admin::create([
                'fullname' => $fullname,
                'phone' => $phone,
                'username' => $username,
                'password' => md5($password)
            ]);
            return redirect('/admin/login')->with('alertsuccess','success');
        }
    }

    /**End Register */

    /**Login */
    public function login()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);
        $admin = Admin::where([['username', $username], ['password', $password]])->first();
        if ($admin == null) {
            return redirect()->back()->with('alert', 'Sai tên đăng nhập hoặc mật khẩu');
        } elseif($admin->active == 0) {
            return redirect()->back()->with('alert', 'Tài khoản chưa được duyệt!');
        } else {
            session(['admin' => $username]);
            return redirect('admin');
        }
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect('admin');
    }
    /**End Login */

    /**Account */

    public function getAcc()
    {
        $accounts = Admin::all();
        return view('admin.account.account',compact('accounts'));
    }

    public function putAcc(Request $request, $id = null)
    {
        $role = $request->roleSelection;
        $active = $request->activeSelection;
        Admin::Where('id',$id)->update([
            'role' => $role,
            'active' => $active
        ]);
        return redirect()->back()->with('alert','Thay đổi thành công!');
    }

    public function delAcc($id = null)
    {
        Admin::Where('id',$id)->delete();
        return redirect()->back()->with('alert','Đã xóa tài khoản!');
    }

    public function getFormChange()
    {
        $account = Admin::Where('username',session('admin'))->first();
        return view('admin.account.change-password',compact('account'));
    }

    public function changePass(Request $request)
    {
        $account = Admin::Where('username',session('admin'))->first();
        $password = $request->password;
        $newpass = $request->newpass;
        $repassword = $request->repassword;
        if($account->password != md5($password)){
            return redirect()->back()->with('alert','Mật khẩu cũ không đúng!');
        } elseif($newpass != $repassword) {
            return redirect()->back()->with('alert','Mật khẩu mới không khớp!');
        } else {
            $account->update([
                'password' => md5($newpass)
            ]);
            return redirect('/admin')->with('alert','Đổi mật khẩu thành công');
        }
    }

    /**End Account */

    /**Product */
    public function getProduct()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.product-ad', compact('products'));
    }

    public function getInforProduct($id = null)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $product = Product::Where('id', $id)->first();
        $image_list = json_decode($product->image_list);
        $brands = Brand::all();
        $catalogs = Catalog::all();
        $sales = Sale::all();
        return view('admin.product.update-product', compact('product', 'brands', 'catalogs', 'sales', 'image_list', 'now'));
    }

    public function putInforProduct(Request $request, $id = null)
    {
        $product = Product::find($id);
        $name = $request->productName;
        $catalog_id = $request->catalogSelection;
        $brand_id = $request->brandSelection;
        $content = $request->txtContent;
        $price = $request->price;
        $sale_id = $request->saleSelection;
        $image_link = $request->file('image');
        if ($image_link != null) {
            $image = $image_link->getClientOriginalName();
            $image_link->move('source/img/products', $image);
            if (file_exists($image)) {
                unlink($image);
            }
        } else {
            $image = $product->image_link;
        }
        $image_list = $request->file('list_image');
        $image_list_json = [];
        if ($image_list != null) {
            $total = count($image_list);
            for ($i = 0; $i < $total; $i++) {
                array_push($image_list_json, '"' . $image_list[$i]->getClientOriginalName() . '"');
            }
            $list = '[' . implode(",", $image_list_json) . ']';
            if (is_array($image_list)) {
                foreach ($image_list as $value) {
                    $img = $value->getClientOriginalName();
                    $value->move('source/img/products', $img);
                    if (file_exists($img)) {
                        unlink($img);
                    }
                }
            }
        } else {
            $list = $product->image_list;
        }
        Product::Where('id', $id)->update([
            'name' => $name,
            'catalog_id' => $catalog_id,
            'brand_id' => $brand_id,
            'content' => $content,
            'price' => $price,
            'sale_id' => $sale_id,
            'image_link' => $image,
            'image_list' => $list
        ]);
        $alert = 'Cập nhật sản phẩm thành công!';
        return redirect()->back()->with('alert', $alert);
    }

    public function getFormProduct()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $brands = Brand::all();
        $catalogs = Catalog::all();
        $sales = Sale::all();
        return view('admin.product.add-product', compact('brands', 'catalogs', 'sales', 'now'));
    }

    public function addProduct(Request $request)
    {
        $name = $request->productName;
        $catalog_id = $request->catalogSelection;
        $brand_id = $request->brandSelection;
        $content = $request->txtContent;
        $price = $request->price;
        $sale_id = $request->saleSelection;

        $image_link = $request->file('image');
        $image = $image_link->getClientOriginalName();
        $image_link->move('source/img/products', $image);
        if (file_exists($image)) {
            unlink($image);
        }

        $image_list = $request->file('list_image');
        $image_list_json = [];
        $total = count($image_list);
        for ($i = 0; $i < $total; $i++) {
            array_push($image_list_json, '"' . $image_list[$i]->getClientOriginalName() . '"');
        }
        $list = '[' . implode(",", $image_list_json) . ']';
        if (is_array($image_list)) {
            foreach ($image_list as $value) {
                $img = $value->getClientOriginalName();
                $value->move('source/img/products', $img);
                if (file_exists($img)) {
                    unlink($img);
                }
            }
        }

        Product::create([
            'name' => $name,
            'catalog_id' => $catalog_id,
            'brand_id' => $brand_id,
            'content' => $content,
            'price' => $price,
            'sale_id' => $sale_id,
            'image_link' => $image,
            'image_list' => $list
        ]);
        $success = 'Thêm mới sản phẩm thành công!';
        return redirect('admin/product')->with('success', $success);
    }
    /**End Product */

    /**Size */
    public function getProductSz()
    {
        $sizes = ProductDetail::orderBy('product_id', 'desc')->get();
        return view('admin.pro-detail.product-sz', compact('sizes'));
    }

    public function addProDetail(Request $request)
    {
        $product_id = $request->productSelection;
        $size = $request->size;
        $quantity = $request->quantity;
        $detail = ProductDetail::Where([['product_id', $product_id], ['size', $size]])->first();
        if ($detail != null) {
            $detail->update(['quantity' => $detail->quantity + $quantity]);
            $alert = 'Cập nhật thêm số lượng vào bản ghi ' . $detail->id;
        } else {
            ProductDetail::create([
                'product_id' => $product_id,
                'size' => $size,
                'quantity' => $quantity
            ]);
            $alert = 'Đã thêm mới 1 bản ghi!';
        }
        return redirect('admin/size')->with('alert', $alert);
    }

    public function getFormProDetail()
    {
        $products = Product::all();
        return view('admin.pro-detail.add-prodetail', compact('products'));
    }

    public function putProDetail(Request $request, $id = null)
    {
        $quantity = $request->quantity;
        ProductDetail::Where('id', $id)->update(['quantity' => $quantity]);
        $alert = 'Thay đổi bản ghi thành công!';
        return redirect()->back()->with('alert', $alert);
    }

    public function delProDetail($id = null)
    {
        ProductDetail::Where('id', $id)->delete();
        $alert = 'Xóa bản ghi thành công!';
        return redirect()->back()->with('alert', $alert);
    }
    /**End Size */

    /**Sale */

    public function getSale()
    {
        $sales = Sale::orderBy('discount', 'desc')->get();
        return view('admin.sale.sale', compact('sales'));
    }

    public function getFormSale()
    {
        return view('admin.sale.add-sale');
    }

    public function addSale(Request $request)
    {
        $discount = $request->discount;
        $date_from = $request->dateFrom;
        $date_to = $request->dateTo;
        Sale::create([
            'discount' => $discount,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $alert = 'Tạo mới thành công!';
        return redirect('admin/sale')->with('alert', $alert);
    }

    public function putSale(Request $request, $id = null)
    {
        $discount = $request->discount;
        $date_from = $request->dateFrom;
        $date_to = $request->dateTo;
        Sale::Where('id', $id)->update([
            'discount' => $discount,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
        $alert = 'Cập nhật bản ghi thành công!';
        return redirect('admin/sale')->with('alert', $alert);
    }

    public function delSale($id = null)
    {
        Product::Where('sale_id', $id)->update(['sale_id' => 1]);
        Sale::Where('id', $id)->delete();
        $alert = 'Xoá thành công!';
        return redirect('admin/sale')->with('alert', $alert);
    }
    /**End Sale */

    /**Rate */

    public function getRate()
    {
        $rates = Rate::all();
        return view('admin.rate.rate', compact('rates'));
    }

    public function putRate(Request $request, $id = null)
    {
        Rate::Where('id', $id)->update(['status' => $request->status]);
        $alert = 'Sửa đổi trạng thái thành công!';
        return redirect('admin/rate')->with('alert', $alert);
    }

    public function delRate($id = null)
    {
        Rate::Where('id', $id)->delete();
        $alert = 'Xoá thành công!';
        return redirect('admin/rate')->with('alert', $alert);
    }

    /**End Rate */

    /**Brand */

    public function getBrand()
    {
        $brands = Brand::all();
        return view('admin.brand.brand', compact('brands'));
    }

    public function getFormBrand()
    {
        return view('admin.brand.add-brand');
    }

    public function addBrand(Request $request)
    {
        $name = $request->name;
        $logo = $request->file('logo');
        if ($logo == null) {
            $image = null;
        } else {
            $image = $logo->getClientOriginalName();
            $logo->move('source/img/products', $image);
            if (file_exists($image)) {
                unlink($image);
            }
        }

        Brand::create([
            'name' => $name,
            'logo' => $image
        ]);
        $alert = 'Thêm mới nhãn hàng thành công!';
        return redirect('admin/brand')->with('alert', $alert);
    }

    public function getInforBrand($id = null)
    {
        $brand = Brand::Where('id', $id)->first();
        return view('admin.brand.update-brand', compact('brand'));
    }

    public function putBrand(Request $request, $id = null)
    {
        $brand = Brand::Where('id', $id)->first();
        $name = $request->name;
        $logo = $request->file('logo');
        if ($logo == null) {
            $image = $brand->logo;
        } else {
            $image = $logo->getClientOriginalName();
            $logo->move('source/img/products', $image);
            if (file_exists($image)) {
                unlink($image);
            }
        }

        $brand->update([
            'name' => $name,
            'logo' => $image
        ]);
        $alert = 'Cập nhật nhãn hàng thành công!';
        return redirect('admin/brand')->with('alert', $alert);
    }

    public function delBrand($id)
    {
        $product = Product::Where('brand_id', $id)->count();
        if ($product == 0) {
            Brand::Where('id', $id)->delete();
            $alert = 'Xoá thành công!';
            return redirect()->back()->with('alert', $alert);
        } else {
            $err = 'Còn sản phẩm của nhãn hàng, chưa thể xóa!';
            return redirect()->back()->with('err', $err);
        }
    }

    /**End Brand */

    /**Catalog */

    public function getCatalog()
    {
        $catalogs = Catalog::all();
        return view('admin.catalog.catalog', compact('catalogs'));
    }
    public function addCatalog(Request $request)
    {
        $name = $request->name;
        Catalog::create(['name' => $name]);
        $alert = 'Thêm mới thành công!';
        return redirect()->back()->with('alert', $alert);
    }
    public function putCatalog(Request $request, $id = null)
    {
        $name = $request->name;
        Catalog::Where('id', $id)->update(['name' => $name]);
        $alert = 'Cập nhật thành công!';
        return redirect()->back()->with('alert', $alert);
    }
    public function delCatalog($id = null)
    {
        $product = Product::Where('catalog_id', $id)->count();
        if ($product == 0) {
            Catalog::Where('id', $id)->delete();
            $alert = 'Xoá thành công!';
            return redirect()->back()->with('alert', $alert);
        } else {
            $err = 'Còn sản phẩm thuộc loại này, không thể xóa!';
            return redirect()->back()->with('err', $err);
        }
    }

    /**End Catalog */

    /**Payment */

    public function getPayment()
    {
        $payments = Payment::all();
        return view('admin.payment.payment', compact('payments'));
    }
    public function addPayment(Request $request)
    {
        $name = $request->name;
        Payment::create(['name' => $name]);
        $alert = 'Thêm mới thành công!';
        return redirect()->back()->with('alert', $alert);
    }
    public function putPayment(Request $request, $id = null)
    {
        $name = $request->name;
        Payment::Where('id', $id)->update(['name' => $name]);
        $alert = 'Cập nhật thành công!';
        return redirect()->back()->with('alert', $alert);
    }
    public function delPayment($id = null)
    {
        $order = Order::Where('payment_id', $id)->count();
        if ($order == 0) {
            Payment::Where('id', $id)->delete();
            $alert = 'Xoá thành công!';
            return redirect()->back()->with('alert', $alert);
        } else {
            $err = 'Có ràng buộc, không thể xóa!';
            return redirect()->back()->with('err', $err);
        }
    }

    /**End Payment */

    /**Order */

    public function getOrder()
    {
        $orders = Order::all();
        return view('admin.order.order',compact('orders'));
    }

    public function getDetail($id = null)
    {
        $order = Order::Where('id',$id)->first();
        $details = OrderDetail::Where('order_id',$id)->get();
        return view('admin.order.detail',compact('order','details'));
    }
    /**End Order */

    /**Customer */

    public function getCustomer()
    {
        $customers = Customer::all();
        return view('admin.customer.customer',compact('customers'));
    }

    /**End Customer */
}
