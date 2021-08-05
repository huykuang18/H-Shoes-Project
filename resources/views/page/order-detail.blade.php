@extends('page.layout.master')
<link rel="stylesheet" href="{{asset('source/css/search.scss')}}">
@section('title','Kiểm tra đơn hàng')
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{asset('checkorder')}}">Kiểm tra đơn hàng</a></li>
            <li class="breadcrumb-item active">Mã đơn: {{$order->id}}</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->
<div class="wishlist-page">
    <div class="container-fluid">
        <div class="wishlist-page-inner">
            <h2>Chi tiết đơn hàng</h2>
            <div class="row">
                <div class="col-md-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Đơn vị bán hàng</h4>
                        <ul>
                            <li>
                                <p>Đơn vị bán hàng:</p><span>Công ty giày dép H-Shoes</span>
                            </li>
                            <li>
                                <p>Email:</p><span>huynq.rma@gmail.com</span>
                            </li>
                            <li>
                                <p>Điện thoại:</p><span>0394366374</span>
                            </li>
                            <li>
                                <p>Kho hàng:</p><span>451 KCN Xuân Phương, Đại lộ Thăng Long, Hà Nội.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Thông tin nhận hàng</h4>
                        <ul>
                            <li>
                                <p>Họ tên:</p><span>{{$order->customer->name}}</span>
                            </li>
                            <li>
                                <p>SĐT:</p><span>{{$order->customer->phone}}</span>
                            </li>
                            <li>
                                <p>Email:</p><span>{{$order->customer->email}}</span>
                            </li>
                            <li>
                                <p>Địa chỉ:</p><span>{{$order->address_ship}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered-inner">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Kích cỡ</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_details as $odt)
                            <tr>
                                <td>
                                    <div class="img">
                                        <a href="{{asset('product/'.$odt->product->id)}}"><img src="{{asset('source/img/products/'.$odt->product->image_link)}}" alt="Image"></a>
                                        <a href="{{asset('product/'.$odt->product->id)}}">{{$odt->product->name}}</a>
                                    </div>
                                </td>
                                <td>{{$odt->size}}</td>
                                <td>{{$odt->quantity}}</td>
                                <td>{{number_format($odt->quantity*$odt->price)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td><b>Tổng tiền:</b></td>
                                <td>{{number_format($order->total)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection