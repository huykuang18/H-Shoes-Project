@extends('admin.layout.main')
@section('title','Tài khoản')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Đơn hàng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả đơn hàng</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @elseif(session('err'))
    <div class="alert alert-danger">{{session('err')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu các tài khoản đã đăng ký
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Thanh toán</th>
                            <th>Tổng</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Xem</th>
                            <th>Hủy</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Thanh toán</th>
                            <th>Tổng</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Chi tiết</th>
                            <th>Hủy</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td>{{$order->address_ship}}</td>
                            <td>{{$order->payment->name}}</td>
                            <td>{{number_format($order->total)}}</td>
                            <td>{{$order->note}}</td>
                            <form method="POST" action="{{asset('admin/order/update/'.$order->id)}}">
                            @csrf
                            <td>
                                <select id="statusSelection" class="form-control" name="statusSelection">
                                @if($order->status == 1)
                                    <option value="1" selected>Chưa xử lý</option>
                                    <option value="2">Đã chuẩn bị</option>
                                    <option value="3">Chuyển cho ship</option>
                                    <option value="4">Đã hoàn thành</option>
                                @elseif($order->status == 2)
                                    <option value="1">Chưa xử lý</option>
                                    <option value="2" selected>Đã chuẩn bị</option>
                                    <option value="3">Chuyển cho ship</option>
                                    <option value="4">Đã hoàn thành</option>
                                @elseif($order->status == 3)
                                    <option value="1">Chưa xử lý</option>
                                    <option value="2">Đã chuẩn bị</option>
                                    <option value="3" selected>Chuyển cho ship</option>
                                    <option value="4">Đã hoàn thành</option>
                                @else
                                    <option value="1">Chưa xử lý</option>
                                    <option value="2">Đã chuẩn bị</option>
                                    <option value="3">Chuyển cho ship</option>
                                    <option value="4" selected>Đã hoàn thành</option>
                                @endif
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-check"></i>
                                </button>
                            </td>
                            </form>
                            <td>
                                <a class="btn btn-primary" href="{{asset('admin/order/detail/'.$order->id)}}">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </td>
                            <td>
                            @if($order->status == 1 || $order->status ==2)
                                <a onclick="return confirm('Bạn thực sự muốn hủy đơn hàng này?')" class="btn btn-danger" href="{{asset('/admin/order/delete/'.$order->id)}}">
                                    <i class="fa fa-ban"></i>
                                </a>
                            @else
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection