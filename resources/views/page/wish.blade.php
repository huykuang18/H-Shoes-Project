@extends('master')
@section('title','Yêu thích')
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{asset('shop')}}">Cửa hàng</a></li>
            <li class="breadcrumb-item active">Sản phẩm yêu thích</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Wishlist Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @if(session("wish"))
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-title">
                                <a href="{{asset('product/'.$product->id)}}">{{$product->name}}</a>
                                @if($product->discount!=0)
                                <div class="sale">
                                    <img src="{{asset('source/img/sale1.png')}}" alt="">
                                    <p>-{{$product->discount}}%</p>
                                </div>
                                @else
                                @endif
                                <div class="ratting">
                                    @if($product->star!=0)
                                    @for ($i = 0; $i < 5; ++$i) <i class="fa fa-star{{ $product->star <= $i ? '-o' : ''}}{{$product->star == $i + .5 ? '-half' : ''}}" aria-hidden="true"></i>
                                        @endfor
                                        @else
                                        &nbsp;
                                        @endif
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
                                <a class="btn" href="{{asset('wish/delete/'.$product->id)}}"><i class="fa fa-heartbeat"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination Start -->
                    {{$products->links()}}
                    <!-- Pagination Start -->
                    @endforeach
                    @else
                    <div class="col-md-12">
                        <div class="product-view-top">
                            <div class="row">
                                <div><p>Không có sản phẩm nào</p></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @include('category')
        </div>
    </div>
</div>
<!-- Wishlist End -->
@endsection