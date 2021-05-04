@extends('master')
@section('title','Thanh toán')
@section('content')
<?php
$total = 0;
?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{asset('shop')}}">Cửa hàng</a></li>
            <li class="breadcrumb-item"><a href="{{asset('cart')}}">Giỏ hàng</a></li>
            <li class="breadcrumb-item active">Thanh toán</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<form method="post">
    @csrf
    <!-- Checkout Start -->
    <div class="checkout">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-inner">
                        <div class="billing-address">
                            <h2>Thông tin đơn hàng</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Họ và tên</label>
                                    <input class="form-control" required name="fullname" type="text" placeholder="Họ tên của bạn">
                                </div>
                                <div class="col-md-6">
                                    <label>Số điện thoại</label>
                                    <input class="form-control" required name="mobile" type="text" placeholder="SĐT của bạn">
                                </div>
                                <div class="col-md-12">
                                    <label>E-mail</label></label>
                                    <input class="form-control" required name="email" type="text" placeholder="Email của bạn">
                                </div>
                                <div class="col-md-12">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" required name="address" type="text" placeholder="Địa chỉ giao hàng">
                                </div>
                                <div class="col-md-12">
                                    <label>Ghi chú</label>
                                    <textarea class="form-control" name="note" type="text" placeholder="Thêm lưu ý"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout-inner">
                        <div class="checkout-summary">
                            <h1>Tóm tắt giỏ hàng</h1>
                            @foreach($products as $product)
                            <p>
                                <a href="{{asset('product/'.$product->id)}}">{{$product->name}}&nbsp;(x{{session("cart.$product->id.number")}})</a>
                                <span>
                                    @if($product->discount==0)
                                    <span>{{number_format($product->price*session("cart.$product->id.number"))}}</span><br>
                                    @else
                                    <span>{{number_format($product->price*(1-0.01*$product->discount)*session("cart.$product->id.number"))}}</span><br>
                                    @endif
                            </p>
                            <?php if ($product->discount == 0) {
                                $total = $total + $product->price * session("cart.$product->id.number");
                            } else {
                                $total = $total + ($product->price * (100 - $product->discount) / 100) * session("cart.$product->id.number");
                            }
                            ?>
                            @endforeach
                            <h2>Tổng tiền<span>{{number_format($total)}}</span></h2>
                            <input type="text" value="{{$total}}" name="total" hidden>
                        </div>

                        <div class="checkout-payment">
                            <div class="payment-methods">
                                <h1>Thanh toán</h1>
                                @foreach($payments as $payment)
                                <div class="payment-method">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="'payment-'.{{$payment->id}}" name="payment" value="{{$payment->id}}" checked>
                                        <label class="custom-control-label" for="'payment-'.{{$payment->id}}">{{$payment->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="checkout-btn">
                                <button type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Checkout End -->
@endsection