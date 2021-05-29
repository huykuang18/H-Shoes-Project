@extends('admin.layout.main')
@section('title','Tài khoản')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Tài khoản quản trị</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tất cả tài khoản</li>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Tài khoản</th>
                            <th>Số điện thoại</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Tài khoản</th>
                            <th>Số điện thoại</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($accounts as $account)
                        <tr>
                            <td>{{$account->id}}</td>
                            <td>{{$account->fullname}}</td>
                            <td>{{$account->username}}</td>
                            <td>{{$account->phone}}</td>
                            <form method="POST" action="{{asset('admin/account/update/'.$account->id)}}">
                            @csrf
                            <td>
                                <select id="roleSelection" class="form-control" name="roleSelection">
                                    @if($account->role == 1)
                                    <option value="1" selected>Quản lý</option>
                                    <option value="0">Nhân viên</option>
                                    @else
                                    <option value="1">Quản lý</option>
                                    <option value="0" selected>Nhân viên</option>
                                    @endif
                                </select>
                            </td>
                            <td>
                                <select id="activeSelection" class="form-control" name="activeSelection">
                                    @if($account->active == 1)
                                    <option value="1" selected>Đã kích hoạt</option>
                                    <option value="0">Chưa kích hoạt</option>
                                    @else
                                    <option value="1">Đã kích hoạt</option>
                                    <option value="0" selected>Chưa kích hoạt</option>
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
                                @if($account->role == 1)
                                @else
                                <a onclick="return confirm('Bạn thực sự muốn xóa bản ghi này?')" class="btn btn-danger" href="{{asset('/admin/account/delete/'.$account->id)}}">
                                    <i class="fa fa-ban"></i>
                                </a>
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