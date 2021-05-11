@extends('page.layout.master')
@section('title','Trang chủ')
@section('content')
@if(session('alert'))
<script>
    alert("Hàng đã đặt thành công! Chúng tôi sẽ liên hệ qua sđt để giao hàng sớm nhất cho bạn");
    location = '/';
</script>
@endif
<!-- Main Slider Start -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset('shop/top')}}"><i class="fa fa-shopping-bag"></i>Bán chạy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset('shop/sale')}}"><i class="fa fa-bolt"></i>Đang giảm giá</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset('shop/catalog/1')}}"><i class="fa fa-female"></i>Giày nữ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset('shop/catalog/2')}}"><i class="fa fa-male"></i>Giày nam</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset('shop/catalog/3')}}"><i class="fa fa-child"></i>Giày trẻ em</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="header-slider normal-slider">
                    <div class="header-slider-item">
                        <img src="source/img/banner3.jpg" alt="Slider Image" />
                    </div>
                    <div class="header-slider-item">
                        <img src="source/img/banner4.jpg" alt="Slider Image" />
                    </div>
                    <div class="header-slider-item">
                        <img src="source/img/banner1.jpg" alt="Slider Image" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-img">
                    <div class="img-item">
                        <img src="source/img/exclusive.jpg" />
                    </div>
                    <div class="img-item">
                        <img src="source/img/banner5.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

<!-- Feature Start-->
<div class="feature">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fab fa-cc-mastercard"></i>
                    <h2>Thanh toán an toàn</h2>
                    <p>
                        Các hình thức đa dạng
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-truck"></i>
                    <h2>Giao hàng toàn quốc</h2>
                    <p>
                        Vận chuyển khắp Việt Nam
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-sync-alt"></i>
                    <h2>Đổi trả dễ dàng</h2>
                    <p>
                        Đổi hàng thoải mái trong 30 ngày
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-comments"></i>
                    <h2>Bảo hành dài hạn</h2>
                    <p>
                        Bảo hành lên đến 60 ngày
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End-->

<!-- Featured Product Start -->
<div class="featured-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>TOP sản phẩm bán chạy</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
            @foreach ($tops as $top)
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        @if($top->discount!=0)
                        <div class="sale">
                            <img src="{{asset('source/img/sale1.png')}}" alt="">
                            <p>-{{$top->discount}}%</p>
                        </div>
                        @else
                        @endif
                        <a href="{{asset('product/'.$top->id)}}">{{$top->name}}</a>
                        <div class="ratting">
                            @if($top->star!=0)
                            @for ($i = 0; $i < 5; ++$i) <i class="fa fa-star{{ $top->star <= $i ? '-o' : ''}}{{$top->star == $i + .5 ? '-half' : ''}}" aria-hidden="true"></i>
                                @endfor
                                @else
                                &nbsp;
                                @endif
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="{{asset('product/'.$top->id)}}">
                            <img src="{{asset('source/img/products/'.$top->image_link)}}" alt="Product Image">
                        </a>
                        <!-- <div class="product-action">
                            <a href="{{asset('cart/add/'.$top->id)}}"><i class="fa fa-cart-plus"></i></a>
                            <a href="#"><i class="fa fa-heart"></i></a>
                            <a href="{{asset('product/'.$top->id)}}"><i class="fa fa-search"></i></a>
                        </div> -->
                    </div>
                    <div class="product-price">
                        <div class="product-price">
                            @if($top->discount==0)
                            <h3>{{number_format($top->price)}}<sup>đ</sup></h3>
                            @else
                            <h3>{{number_format($top->price*(100-$top->discount)*0.01)}}<sup>đ</sup></h3>
                            @endif
                            <a class="btn" href="{{asset('wish/add/'.$top->id)}}"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Featured Product End -->

<!-- Newsletter Start -->
<div class="newsletter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Đăng ký nhận thông báo mới</h1>
            </div>
            <div class="col-md-6">
                <div class="form">
                    <input type="email" value="" placeholder="Email của bạn">
                    <button>OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter End -->

<!-- Recent Product Start -->
<div class="recent-product product">
    <div class="container-fluid">
        <div class="section-header">
            <h1>Sản phẩm ưu đãi</h1>
        </div>
        <div class="row align-items-center product-slider product-slider-4">
            @foreach ($sales as $sale)
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="{{asset('product/'.$sale->id)}}">{{$sale->name}}</a>
                        @if($sale->discount!=0)
                        <div class="sale">
                            <img src="{{asset('source/img/sale1.png')}}" alt="">
                            <p>-{{$sale->discount}}%</p>
                        </div>
                        @else
                        @endif
                        <div class="ratting">
                            @if($sale->star!=0)
                            @for ($i = 0; $i < 5; ++$i) <i class="fa fa-star{{ $sale->star <= $i ? '-o' : ''}}{{$sale->star == $i + .5 ? '-half' : ''}}" aria-hidden="true"></i>
                                @endfor
                                @else
                                &nbsp;
                                @endif
                        </div>
                    </div>
                    <div class="product-image">
                        <a href="{{asset('product/'.$sale->id)}}">
                            <img src="{{asset('source/img/products/'.$sale->image_link)}}" alt="Product Image">
                        </a>
                    </div>
                    <div class="product-price">
                        @if($sale->discount==0)
                        <h3>{{number_format($sale->price)}}<sup>đ</sup></h3>
                        @else
                        <h3>{{number_format($sale->price*(100-$sale->discount)*0.01)}}<sup>đ</sup></h3>
                        @endif
                        <a class="btn" href="{{asset('wish/add/'.$sale->id)}}"><i class="fa fa-heart"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Recent Product End -->

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

<!-- Category Start-->
<div class="category">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="source/img/category-3.jpg" />
                    <a class="category-name" href="">
                        <!-- <p>Some text goes here that describes the image</p> -->
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-250">
                    <img src="source/img/category-7.jpg" />
                    <a class="category-name" href="">
                        <!-- <p>Some text goes here that describes the image</p> -->
                    </a>
                </div>
                <div class="category-item ch-150">
                    <img src="source/img/category-6.jpg" />
                    <a class="category-name" href="">
                        <!-- <p>Some text goes here that describes the image</p> -->
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-150">
                    <img src="source/img/category-5.jpg" />
                    <a class="category-name" href="">
                        <!-- <p>Some text goes here that describes the image</p> -->
                    </a>
                </div>
                <div class="category-item ch-250">
                    <img src="source/img/category-4.jpg" />
                    <a class="category-name" href="">
                        <!-- <p>Some text goes here that describes the image</p> -->
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-item ch-400">
                    <img src="source/img/category-8.jpg" />
                    <a class="category-name" href="">
                        <!-- <p>Some text goes here that describes the image</p> -->
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category End-->

<!-- Call to Action Start -->
<div class="call-to-action">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Liên hệ để được hỗ trợ</h1>
            </div>
            <div class="col-md-6">
                <a href="tel:0394366374">+84 394 366 374</a>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

@endsection