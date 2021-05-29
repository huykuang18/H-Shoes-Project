@extends('admin.layout.main')
@section('title','Đánh giá')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Đánh giá sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả đánh giá</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu tất cả đánh giá sản phẩm
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Tên</th>
                            <th>SĐT</th>
                            <th>Số sao</th>
                            <th>Bình luận</th>
                            <th>Lựa chọn</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Tên</th>
                            <th>SĐT</th>
                            <th>Số sao</th>
                            <th>Bình luận</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($rates as $rate)
                        <tr>
                            <form method="POST" action="{{asset('/admin/rate/update/'.$rate->id)}}">
                                @csrf
                                <td>{{$rate->id}}</td>
                                <td>{{$rate->product->name}}</td>
                                <td>{{$rate->name}}</td>
                                <td>{{$rate->phone}}</td>
                                <td>{{$rate->star}}</td>
                                <td>{{$rate->note}}</td>
                                <td>
                                    <select id="status" class="form-control" name="status">
                                        @if($rate->status == 1)
                                        <option value="1" selected>Hiện</option>
                                        <option value="0">Ẩn</option>
                                        @else
                                        <option value="0" selected>Ẩn</option>
                                        <option value="1">Hiện</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    @if($rate->status == 1)
                                    <button class="btn btn-dark" type="submit"><i class="fa fa-eye-slash"></i></button>
                                    @else
                                    <button class="btn btn-dark" type="submit"><i class="fa fa-eye"></i></button>
                                    @endif
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/rate/delete/'.$rate->id)}}">
                                        <i class="fa fa-ban"></i>
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