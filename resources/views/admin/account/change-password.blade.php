@extends('admin.layout.main')
@section('title','Đổi mật khẩu')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Đổi mật khẩu</h1>
    <div class="card mb-4 bg-primary">
        @if(session('alert'))
        <div class="alert alert-danger">{{session('alert')}}</div>
        @endif
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mật khẩu hiện tại</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Nhập mật khẩu hiện tại" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="newpass">Mật khẩu mới</label>
                    <input class="form-control" type="password" id="newpass" name="newpass" placeholder="Nhập mật khẩu mới" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="repassword">Xác nhận mật khẩu mới</label>
                    <input class="form-control" type="password" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu mới" required>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-redlight"><i class="fa fa-check"></i> Cập nhật</button>
            <button type="reset" class="btn btn-redlight"><i class="fa fa-redo"></i> Đặt lại</button>
        </form>
    </div>
</div>
@endsection