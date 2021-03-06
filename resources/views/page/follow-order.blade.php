@extends('page.layout.master')
<link rel="stylesheet" href="{{asset('source/css/search.scss')}}">
@section('title','Kiểm tra đơn hàng')
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active">Kiểm tra đơn hàng</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <h3>Kiểm tra đơn hàng đã đặt trên H-Shoes</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="get" action="{{url('checkorder/search')}}" class="product-search">
                                        <input type="number" name="phone" placeholder="Nhập số điện thoại" required>
                                        <button><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            @if(session('alert'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">{{session('alert')}}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                @if($orders==null)
                @else
                <div class="wishlist-page">
                    <div class="container-fluid">
                        <div class="wishlist-page-inner">
                            <p>Khách hàng: <b>{{$customer->name}}</b></p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Mã đơn</th>
                                            <th>Thời gian đặt</th>
                                            <th>Thanh toán</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->payment->name}}</td>
                                            <td>{{number_format($order->total)}}</td>
                                            <td>
                                                @if ($order->status==1)
                                                Chưa xử lý
                                                @elseif ($order->status==2)
                                                Đã xác nhận
                                                @elseif ($order->status==3)
                                                Giao cho bên vận chuyển
                                                @else
                                                Đã hoàn thành
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="{{asset('checkorder/detail/'.$order->id)}}" class="btn"><i class="fa fa-search"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Product List End -->
@endsection