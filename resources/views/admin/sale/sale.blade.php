@extends('admin.layout.main')
@section('title','Giảm giá')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Giảm giá sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Các chương trình khuyến mại</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu các loại giảm giá
            <a class="btn btn-sm btn-dark" href="{{asset('/admin/sale/add')}}">
                <i class="fa fa-plus-square mr-9"></i>&nbsp;Thêm mới bản ghi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Giảm giá</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Giảm giá</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <form method="POST" action="{{asset('/admin/sale/update/'.$sale->id)}}">
                                @csrf
                                <td>{{$sale->id}}</td>
                                <td>
                                    <input class="form-control" type="number" name="discount" value="{{$sale->discount}}">
                                </td>
                                <td>
                                    <input class="form-control" type="date" name="dateFrom" value="{{$sale->date_from}}">
                                </td>
                                <td>
                                    <input class="form-control" type="date" name="dateTo" value="{{$sale->date_to}}">
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>&nbsp;Cập nhật</button>
                                    @if($sale->id == 1)
                                    @else
                                    <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/sale/delete/'.$sale->id)}}">
                                        <i class="fa fa-ban"></i>&nbsp;Xóa
                                    </a>
                                    @endif
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