@extends('admin.layout.main')
@section('title','Khách hàng')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Danh sách khách hàng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả khách hàng</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu thông tin khách hàng
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Số lượt mua hàng</th>
                            <th>Thời gian mua hàng gần nhất</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Số lượt mua hàng</th>
                            <th>Thời gian mua hàng gần nhất</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->purchased}}</td>
                            <td>{{$customer->updated_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection