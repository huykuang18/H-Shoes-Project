@extends('master')
@section('title','Chi tiết sản phẩm')
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/shop">Cửa hàng</a></li>
            <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                @if(is_array($image_list))
                                @foreach($image_list as $img)
                                <img src="{{asset('source/img/products/'.$img)}}" alt="Product Image">
                                @endforeach
                                @endif
                            </div>
                            <div class="product-slider-single-nav normal-slider">
                                @if(is_array($image_list))
                                @foreach($image_list as $img)
                                <div class="slider-nav-img"><img src="{{asset('source/img/products/'.$img)}}" alt="Product Image"></div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form action="{{asset('cart/add/'.$product->id)}}" method="post">
                                @csrf
                                <div class="product-content">
                                    <div class="title">
                                        <h2>{{$product->name}}</h2>
                                    </div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price">
                                        <h4>Đơn giá:</h4>
                                        @if($product->discount!=0)
                                        <p>{{number_format($product->price*(100-$product->discount)*0.01)}} <span>{{$product->price}}</span></p>
                                        @else
                                        <p>{{number_format($product->price)}}</p>
                                        @endif
                                    </div>
                                    <div class="type">
                                        <h4>Loại:</h4>
                                        <div class="tag">
                                            <a href="{{asset('shop/brand/'.$product->brand->id)}}">{{$product->brand->name}}</a>
                                            <a href="{{asset('shop/catalog/'.$product->catalog->id)}}">{{$product->catalog->name}}</a>
                                        </div>
                                    </div>
                                    <div class="quantity">
                                        <h4>Số lượng:</h4>
                                        <div class="qty">
                                            <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                                            <input autocomplete="on" min="1" max="99" type="text" name="number" value='1'>
                                            <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="p-size">
                                        <h4>Kích cỡ:</h4>
                                        <div class="btn-group btn-group-sm" for="sizes">
                                            <!-- <input class="btn" type="text" id="size" name="size" value=""> -->
                                            <select id="sizes" name="size">
                                                @foreach($sizes as $size)
                                                <option value="{{$size->size}}">{{$size->size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="buyed">
                                        <h4>Đã bán:</h4>
                                        <p>{{$product->buyed}}</p>
                                    </div>
                                    <div class="action">
                                        <button class="btn" type="submit"><i class="fa fa-shopping-cart"></i>&nbsp;Thêm vào giỏ</button>
                                        <a class="btn" href="{{asset('wish/add/'.$product->id)}}"><i class="fa fa-heart"></i>&nbsp;Yêu thích</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row product-detail-bottom">
                    <div class="col-lg-12">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#description">Thông tin sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#reviews">Đánh giá</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="description" class="container tab-pane active">
                                <h4>Thông tin sản phẩm</h4>
                                <p>
                                <ul>
                                    @foreach($contents as $content)
                                    <li>{{$content}}</li>
                                    @endforeach
                                </ul>
                                </p>
                            </div>
                            <div id="reviews" class="container tab-pane fade">
                                <div class="reviews-submitted">
                                    <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                                    </p>
                                </div>
                                <div class="reviews-submit">
                                    <h4>Give your Review:</h4>
                                    <div class="ratting">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <div class="row form">
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" placeholder="Email">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea placeholder="Review"></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <button>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product">
                    <div class="section-header">
                        <h1>Có thể bạn muốn mua</h1>
                    </div>

                    <div class="row align-items-center product-slider product-slider-3">

                        @foreach($products as $relate)
                        <div class="col-lg-4">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="{{asset('product/'.$relate->id)}}">{{$relate->name}}</a>
                                    @if($relate->discount!=0)
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
                                    <a href="{{asset('product/'.$relate->id)}}">
                                        <img src="{{asset('source/img/products/'.$relate->image_link)}}" alt="Product Image">
                                    </a>
                                    <!-- <div class="product-action">
                                        <a href="{{asset('cart/add/'.$relate->id)}}"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="{{asset('product/'.$relate->id)}}"><i class="fa fa-search"></i></a>
                                    </div> -->
                                </div>
                                <div class="product-price">
                                    @if($relate->discount==0)
                                    <h3>{{number_format($relate->price)}}<sup>đ</sup></h3>
                                    @else
                                    <h3>{{number_format($relate->price*(100-$relate->discount)*0.01)}}<sup>đ</sup></h3>
                                    @endif
                                    <a class="btn" href="{{asset('wish/add/'.$relate->id)}}"><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('category')
        </div>
    </div>
</div>
<!-- Product Detail End -->
@endsection