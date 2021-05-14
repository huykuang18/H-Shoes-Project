@extends('admin.layout.main')
@section('title','Chi tiết đơn hàng')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Chi tiết đơn hàng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Mã đơn: {{$order->id}}</li>
        <li class="breadcrumb-item active">Thời gian đặt: {{$order->created_at}}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Sản phẩm đã đặt
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Kích cỡ</th>
                            <th>Giá mua</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                        <tr>
                            <td><img src="{{asset('source/img/products/'.$detail->product->image_link)}}" alt="image detail"></td>
                            <td>{{$detail->product->name}}</td>
                            <td>{{number_format($detail->price)}}</td>
                            <td>{{$detail->price}}</td>
                            <td>{{$detail->quantity}}</td>
                            <td>{{number_format($detail->price * $detail->quantity)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4"></td>
                            <td><b>Tổng:</b></td>
                            <td>{{number_format($order->total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection