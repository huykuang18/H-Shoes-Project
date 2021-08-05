<?php

use App\Models\Admin;

$account = Admin::Where('username',session('admin'))->first();
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{asset('/admin')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @if($account->role != 1)
                @else
                <div class="sb-sidenav-menu-heading">QUẢN LÝ</div>
                <a class="nav-link" href="{{asset('/admin/account')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                    Tài khoản quản trị
                </a>
                @endif
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="false" aria-controls="product">
                    <div class="sb-nav-link-icon"><i class="fa fa-paw"></i></div>
                    Sản phẩm
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="product" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{asset('/admin/product')}}"><div class="sb-nav-link-icon"><i class="fa fa-list"></i></div>Danh sách</a>
                        <a class="nav-link" href="{{asset('/admin/size')}}"><div class="sb-nav-link-icon"><i class="fa fa-compress"></i></div>Kích cỡ</a>
                        <a class="nav-link" href="{{asset('/admin/sale')}}"><div class="sb-nav-link-icon"><i class="fa fa-percent"></i></div>Giảm giá</a>
                        <a class="nav-link" href="{{asset('/admin/rate')}}"><div class="sb-nav-link-icon"><i class="fa fa-comments"></i></div>Đánh giá</a>
                    </nav>
                </div>

                <a class="nav-link" href="{{asset('/admin/brand')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-bookmark"></i></div>
                    Thương hiệu
                </a>
                <a class="nav-link" href="{{asset('/admin/catalog')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Danh mục sản phẩm
                </a>
                <a class="nav-link" href="{{asset('/admin/order')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Đơn hàng
                </a>
                <a class="nav-link" href="{{asset('/admin/payment')}}">
                    <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                    Phương thức thanh toán
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Đăng nhập bởi:</div>
            {{session('admin')}}
        </div>
    </nav>
</div>