@extends('admin.layout.main')
@section('title','Thêm nhãn hàng')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Nhãn hàng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{asset('admin/size')}}">Tất cả nhãn hàng</a></li>
        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>
    <div class="card mb-4 bg-primary">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="brandName">Tên nhãn hàng</label>
                    <input type="text" class="form-control" id="brandName" name="name" placeholder="Tên nhãn hàng" required>
                </div>
            </div>
            <div class="form-group">
                <label for="logo">Chọn hình ảnh cho logo</label><br>
                <input type="file" id="logo" name="logo">
            </div>
            <button type="submit" class="btn btn-outline-redlight"><i class="fa fa-plus"></i> Thêm</button>
            <button type="reset" class="btn btn-redlight"><i class="fa fa-redo"></i> Đặt lại</button>
        </form>
    </div>
</div>
@endsection