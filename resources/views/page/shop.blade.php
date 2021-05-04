@extends('master')
@section('title','Cửa hàng')
@section('content')

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active">Cửa hàng</li>
            <li class="breadcrumb-item">{{$title}}</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @if(count($products)==0)
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div>
                                    <p>Không có sản phẩm nào</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Thương hiệu</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @foreach($brands as $brand)
                                                <a href="{{asset('shop/brand/'.$brand->id)}}" class="dropdown-item">{{$brand->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Sắp xếp theo</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{asset('shop/newest')}}" class="dropdown-item">Mới nhất</a>
                                                <a href="{{asset('shop/topsale')}}" class="dropdown-item">Giảm giá nhiều</a>
                                                <a href="{{asset('shop/desc')}}" class="dropdown-item">Giá giảm dần</a>
                                                <a href="{{asset('shop/asc')}}" class="dropdown-item">Giá tăng dần</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-price-range">
                                        <div class="dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">Khoảng giá sản phẩm</div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{asset('shop/price/0')}}" class="dropdown-item">Dưới 500.000</a>
                                                <a href="{{asset('shop/price/500000')}}" class="dropdown-item">500.000 - 1 triệu</a>
                                                <a href="{{asset('shop/price/1000000')}}" class="dropdown-item">Trên 1 triệu</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="{{asset('product/'.$product->id)}}">{{$product->name}}</a>
                                @if($product->discount!=0)
                                <div class="sale"><img src="{{asset('source/img/sale.png')}}" alt=""></div>
                                @else
                                @endif
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="product-image">
                                <a href="{{asset('product/'.$product->id)}}">
                                    <img src="{{asset('source/img/products/'.$product->image_link)}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-price">
                                @if($product->discount==0)
                                <h3>{{number_format($product->price)}}<sup>đ</sup></h3>
                                @else
                                <h3>{{number_format($product->price*(100-$product->discount)*0.01)}}<sup>đ</sup></h3>
                                @endif
                                <a class="btn" href="{{asset('wish/add/'.$product->id)}}"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <!-- Pagination Start -->
                {{$products->links()}}
                <!-- Pagination Start -->
            </div>
            @include('category')
        </div>
    </div>
</div>
<!-- Product List End -->

<!-- Brand Start -->
<div class="brand">
    <div class="container-fluid">
        <div class="brand-slider">
            <div class="brand-item"><img src="source/img/brands/brand-1.jpg" alt=""></div>
            <div class="brand-item"><img src="source/img/brands/brand-2.jpg" alt=""></div>
            <div class="brand-item"><img src="source/img/brands/brand-3.jpg" alt=""></div>
            <div class="brand-item"><img src="source/img/brands/brand-4.jpg" alt=""></div>
            <div class="brand-item"><img src="source/img/brands/brand-5.jpg" alt=""></div>
            <div class="brand-item"><img src="source/img/brands/brand-3.jpg" alt=""></div>
        </div>
    </div>
</div>
<!-- Brand End -->

@endsection