@extends('admin.layout.main')
@section('title','Sản phẩm')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
    </ol>
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu sản phẩm
            <a class="btn btn-sm btn-dark" href="{{asset('/admin/product/add')}}">
                <i class="fa fa-plus-square mr-9"></i>&nbsp;Thêm mới sản phẩm
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Thương hiệu</th>
                            <th>Loại</th>
                            <th>Giá</th>
                            <th>Khuyến mại</th>
                            <th>Đã bán</th>
                            <th>Cập nhật</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Thương hiệu</th>
                            <th>Loại</th>
                            <th>Giá</th>
                            <th>Khuyến mại</th>
                            <th>Đã bán</th>
                            <th>Cập nhật</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td><img src="{{asset('source/img/products/'.$product->image_link)}}" alt="image product"></td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->catalog->name}}</td>
                            <td>{{number_format($product->price)}}</td>
                            <td>{{$product->sale->discount}}%</td>
                            <td>{{$product->buyed}}</td>
                            <td>
                                <a class="btn btn-secondary" href="{{asset('admin/product/edit/'.$product->id)}}">
                                    <i class="fa fa-edit"></i>
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