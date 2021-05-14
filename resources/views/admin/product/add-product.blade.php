@extends('admin.layout.main')
@section('title','Thêm sản phẩm')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{asset('admin/product')}}">Danh sách sản phẩm</a></li>
        <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
    </ol>
    <div class="card mb-4 bg-primary">
        @if(session('alert'))
        <div class="alert alert-success">{{session('alert')}}</div>
        @endif
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="productName">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="productName" placeholder="Tên sản phẩm" name="productName" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="brandSelection">Nhãn hàng</label>
                    <select id="brandSelection" class="form-control" name="brandSelection">
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="catalogSelection">Danh mục</label>
                    <select id="catalogSelection" class="form-control" name="catalogSelection">
                        @foreach($catalogs as $catalog)
                        <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="uploadImg">Tải lên ảnh chính</label><br>
                <input type="file" id="uploadImg" placeholder="Tải ảnh lên" name="image" required>
            </div>
            <div class="form-group">
                <label for="list_image">Chọn hình ảnh chi tiết</label><br>
                <input type="file" id="list_image" name="list_image[]" multiple required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPrice">Đơn giá</label>
                    <input type="number" class="form-control" id="inputPrice" name="price" placeholder="Đơn giá bán" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="saleSelection">Khuyến mại</label>
                    <select id="saleSelection" class="form-control" name="saleSelection">
                        @foreach($sales as $sale)
                        @if($sale->id == 1)
                        <option value="{{$sale->id}}">Không</option>
                        @elseif($sale->date_from <= $now->toDateString() && $sale->date_to >= $now->toDateString())
                        <option value="{{$sale->id}}">{{$sale->discount}}% (Còn hiệu lực)</option>
                        @else
                        <option value="{{$sale->id}}">{{$sale->discount}}% (Hết hiệu lực)</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="txtContent">Mô tả</label>
                <textarea class="form-control" name="txtContent" id="txtContent" cols="30" rows="10" placeholder="Mô tả sản phẩm"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-redlight"><i class="fa fa-plus"></i> Thêm</button>
            <button type="reset" class="btn btn-redlight"><i class="fa fa-redo"></i> Đặt lại</button>
        </form>
    </div>
</div>
@endsection