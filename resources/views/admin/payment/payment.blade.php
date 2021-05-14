@extends('admin.layout.main')
@section('title','Phương thức thanh toán')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Các phương thức thanh toán</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả phương thức</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @elseif(session('err'))
    <div class="alert alert-danger">{{session('err')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu các phương thức thanh toán
            <a class="btn btn-sm btn-dark" onclick="hiden()">
                <i class="fa fa-plus-square mr-9"></i>&nbsp;Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phương thức</th>
                            <th>Xác nhận</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Phương thức</th>
                            <th>Xác nhận</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr id="formAddPayment" style="display: none;">
                            <td></td>
                            <form method="POST" action="{{asset('admin/payment/add')}}">
                                @csrf
                                <td><input class="form-control" type="text" name="name" placeholder="Thêm phương thức" required></td>
                                <td>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </form>
                            <td></td>
                        </tr>
                        @foreach($payments as $payment)
                        <form method="POST" action="{{asset('admin/payment/update/'.$payment->id)}}">
                            @csrf
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td><input class="form-control" type="text" name="name" value="{{$payment->name}}" required></td>
                                <td>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/payment/delete/'.$payment->id)}}">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection