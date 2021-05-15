@extends('page.layout.master')
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
                                        @if($product->star!=0)
                                        @for ($i = 0; $i < 5; ++$i) <i class="fa fa-star{{ $product->star <= $i ? '-o' : ''}}{{$product->star == $i + .5 ? '-half' : ''}}" aria-hidden="true"></i>
                                            @endfor
                                            @else
                                            <p>Chưa có đánh giá</p>
                                            @endif
                                    </div>
                                    <div class="price">
                                        <h4>Đơn giá:</h4>
                                        @if($product->sale->sale_id!=1 && $product->sale->date_from <= $now && $product->sale->date_to >= $now)
                                        <p>{{number_format($product->price*(100-($product->sale->discount))*0.01)}} <span>{{number_format($product->price)}}</span></p>
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
                                    @foreach($rates as $rate)
                                    <div class="reviewer">{{$rate->name}}&nbsp;<span>{{$rate->created_at}}</span></div>
                                    <div class="ratting">
                                        @for ($i = 0; $i < 5; ++$i) <i class="fa fa-star{{ $rate->star <= $i ? '-o' : ''}}{{$rate->star == $i + .5 ? '-half' : ''}}" aria-hidden="true"></i>
                                            @endfor
                                    </div>
                                    <p>
                                        {{$rate->note}}
                                    </p>
                                    @endforeach
                                </div>
                                <div class="reviews-submit">
                                    <h4>Gửi đánh giá của bạn:</h4>
                                    <form method="post" action="{{url('rate/'.$product->id)}}">
                                        @csrf
                                        <input id="input-21b" name="star" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="md" required title="">
                                        <div class="clearfix"></div>
                                        <div class="row form">
                                            <div class="col-sm-6">
                                                <input type="text" name="name" placeholder="Họ tên" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="number" name="phone" placeholder="Số điện thoại" required>
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea name="comment" placeholder="Bình luận"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit">Gửi</button>
                                            </div>
                                        </div>
                                    </form>
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
                                    @if($relate->sale->sale_id!=1 && $relate->sale->date_from <= $now && $relate->sale->date_to >= $now)
                                    <div class="sale">
                                        <img src="{{asset('source/img/sale1.png')}}" alt="">
                                        <p>-{{$relate->sale->discount}}%</p>
                                    </div>
                                    @else
                                    @endif
                                    <div class="ratting">
                                        @if($relate->star!=0)
                                        @for ($i = 0; $i < 5; ++$i) <i class="fa fa-star{{ $relate->star <= $i ? '-o' : ''}}{{$relate->star == $i + .5 ? '-half' : ''}}" aria-hidden="true"></i>
                                            @endfor
                                            @else
                                            &nbsp;
                                            @endif
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
                                    @if($relate->sale->sale_id!=1 && $relate->sale->date_from <= $now && $relate->sale->date_to >= $now)
                                    <h3>{{number_format($relate->price*(100-$relate->sale->discount)*0.01)}}<sup>đ</sup></h3>
                                    @else
                                    <h3>{{number_format($relate->price)}}<sup>đ</sup></h3>
                                    @endif
                                    <a class="btn" href="{{asset('wish/add/'.$relate->id)}}"><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('page.layout.category')
        </div>
    </div>
</div>
<!-- Product Detail End -->
@endsection