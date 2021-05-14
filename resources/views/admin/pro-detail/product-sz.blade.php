@extends('admin.layout.main')
@section('title','Kích cỡ')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Kích cỡ từng sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Thông tin chi tiết</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu kích cỡ
            <a class="btn btn-sm btn-dark" href="{{asset('/admin/pro-detail/add')}}">
                <i class="fa fa-plus-square mr-9"></i>&nbsp;Thêm mới bản ghi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Kích cỡ</th>
                            <th>Số lượng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Kích cỡ</th>
                            <th>Số lượng</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($sizes as $size)
                        <tr>
                            <td>{{$size->id}}</td>
                            <td>
                            <img src="{{asset('source/img/products/'.$size->product->image_link)}}" alt="image product">
                            {{$size->product->name}}
                            </td>
                            <td>{{$size->size}}</td>
                            <form method="POST" action="{{asset('/admin/pro-detail/update/'.$size->id)}}">
                                @csrf
                                <td>
                                    <input class="form-control" type="number" name="quantity" value="{{$size->quantity}}">
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;Cập nhật</button>
                                    <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/pro-detail/delete/'.$size->id)}}">
                                        <i class="fa fa-ban"></i>&nbsp;Xóa
                                    </a>
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection