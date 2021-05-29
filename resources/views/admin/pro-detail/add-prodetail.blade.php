@extends('admin.layout.main')
@section('title','Nhập thêm kích cỡ sản phẩm')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Kích cỡ</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{asset('admin/size')}}">Thông tin chi tiết</a></li>
        <li class="breadcrumb-item active">Nhập thêm kích cỡ sản phẩm</li>
    </ol>
    <div class="card mb-4 bg-primary">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="productSelection">Chọn sản phẩm</label>
                    <select id="productSelection" class="form-control" name="productSelection">
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->id}}-{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputSize">Kích cỡ</label>
                    <input type="number" min="0" max="43" class="form-control" id="inputSize" name="size" placeholder="Kích cỡ" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputQty">Số lượng</label>
                    <input type="number" min="0" class="form-control" id="inputQty" name="quantity" placeholder="Số lượng nhập" required>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-redlight"><i class="fa fa-plus"></i> Thêm</button>
            <button type="reset" class="btn btn-redlight"><i class="fa fa-redo"></i> Đặt lại</button>
        </form>
    </div>
</div>
@endsection