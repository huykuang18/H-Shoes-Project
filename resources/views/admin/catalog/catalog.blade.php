@extends('admin.layout.main')
@section('title','Thể loại')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Phân loại sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả thể loại</li>
    </ol>
    @if(session('alert'))
    <div class="alert alert-success">{{session('alert')}}</div>
    @elseif(session('err'))
    <div class="alert alert-danger">{{session('err')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Bảng dữ liệu phân loại sản phẩm
            <a onclick="hidenShow()" class="btn btn-sm btn-dark">
                <i class="fa fa-plus-square mr-9"></i>&nbsp;Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thể loại</th>
                            <th>Xác nhận</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Thể loại</th>
                            <th>Xác nhận</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr id="formAdd" style="display: none;">
                            <td></td>
                            <form method="POST" action="{{asset('admin/catalog/add')}}">
                                @csrf
                                <td><input class="form-control" type="text" name="name" placeholder="Thêm thể loại" required></td>
                                <td>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                            </form>
                            <td></td>
                        </tr>
                        @foreach($catalogs as $catalog)
                        <form method="POST" action="{{asset('admin/catalog/update/'.$catalog->id)}}">
                            @csrf
                            <tr>
                                <td>{{$catalog->id}}</td>
                                <td><input class="form-control" type="text" name="name" value="{{$catalog->name}}" required></td>
                                <td>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/catalog/delete/'.$catalog->id)}}">
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