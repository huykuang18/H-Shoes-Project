@extends('admin.layout.main')
@section('title','Nhãn hàng')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Nhãn hàng của sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả nhãn hàng</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @elseif(session('err'))
    <div class="alert alert-danger">{{session('err')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu các nhãn hàng của sản phẩm
            <a class="btn btn-sm btn-dark" href="{{asset('/admin/brand/add')}}">
                <i class="fa fa-plus-square mr-9"></i>&nbsp;Thêm nhãn hàng
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên nhãn hàng</th>
                            <th>Logo</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên nhãn hàng</th>
                            <th>Logo</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td><img src="{{asset('source/img/brands/'.$brand->logo)}}" alt="logo"></td>
                            <td>
                                <a class="btn btn-dark" href="{{asset('/admin/brand/update/'.$brand->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/brand/delete/'.$brand->id)}}">
                                    <i class="fa fa-ban"></i>
                                </a>
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