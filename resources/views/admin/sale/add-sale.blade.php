@extends('admin.layout.main')
@section('title','Tạo mới CTKM')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Giảm giá</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{asset('admin/sale')}}">Các chương trình khuyến mại</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>
    <div class="card mb-4 bg-primary">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPrice">Giảm giá</label>
                    <input type="number" min="0" max="100" class="form-control" id="inputPrice" name="discount" placeholder="Phần trăm khuyến mại" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="dateFrom">Thời gian bắt đầu</label>
                    <input type="date" class="form-control" id="dateFrom" name="dateFrom" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="dateTo">Thời gian kết thúc</label>
                    <input type="date" class="form-control" id="dateTo" name="dateTo" required>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-redlight"><i class="fa fa-plus"></i> Thêm</button>
            <button type="reset" class="btn btn-redlight"><i class="fa fa-redo"></i> Đặt lại</button>
        </form>
    </div>
</div>
@endsection