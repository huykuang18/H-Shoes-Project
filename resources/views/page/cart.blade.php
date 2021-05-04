@extends('master')
@section('title','Giỏ hàng')
@section('content')

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{asset('shop')}}">Cửa hàng</a></li>
            <li class="breadcrumb-item active">Giỏ hàng</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->
@if(session('cart'))
<?php
$total = 0;
$sale = 0;
?>
<!-- Cart Start -->
<form method="post" action="{{url('cart/update')}}" id="formCart">
    @csrf
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Kích cỡ</th>
                                        <th>Tổng</th>
                                        <th>Xoá</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <div class="img">
                                                <a href="{{asset('product/'.$product->id)}}"><img src="{{asset('source/img/products/'.$product->image_link)}}" alt="Image"></a>
                                                <a href="{{asset('product/'.$product->id)}}">{{$product->name}}</a>
                                            </div>
                                        </td>
                                        <td>{{number_format($product->price)}}</td>
                                        <td>
                                            <div class="qty">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input autocomplete="on" min="1" max="99" type="text" name="{{$product->id}}number" value='{{session("cart.$product->id.number")}}'>
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            {{session("cart.$product->id.size")}}
                                        </td>
                                        <td>{{number_format($product->price*session("cart.$product->id.number"))}}</td>
                                        <td><a class="btn" href="{{url('cart/delete/'.$product->id)}}"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                    $sale = $sale + $product->price * $product->discount * 0.01 * session("cart.$product->id.number");
                                    $total = $total + $product->price * session("cart.$product->id.number");
                                    ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <!-- <div class="col-md-12">
                                <div class="coupon">
                                    <input type="text" placeholder="Coupon Code">
                                    <button>Apply Code</button>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Tóm tắt</h1>
                                        <p>Thành tiền<span>{{number_format($total)}}</span></p>
                                        <p>Tiết kiệm<span>{{number_format($sale)}}</span></p>
                                        <h2>Tổng tiền<span>{{number_format($total-$sale)}}</span></h2>
                                    </div>
                                    <div class="cart-btn">
                                        <input class="button" type="submit" value="Cập nhật">
                                        <input onclick="window.location.href='checkout'" type="button" class="button" value="Thanh toán">
                                        <!-- <a onclick="return confirm('Bạn muốn xóa giỏ hàng chứ?')" href="{{url('cart/deleteall')}}" class="btn_1">Xóa tất cả</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@else
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 cart-page-inner">
                Chưa có sản phẩm nào trong giỏ hàng
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
@endif
<!-- Cart End -->
@endsection