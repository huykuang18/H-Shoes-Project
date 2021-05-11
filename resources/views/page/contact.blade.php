@extends('page.layout.master')
@section('title','Liên hệ')
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active">Liên hệ</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Contact Start -->
<div class="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form">
                    <form method="POST" action="{{asset('message/send')}}">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Tên của bạn" />
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="mail" class="form-control" placeholder="Gmail" />
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="5" placeholder="Phản hồi của bạn"></textarea>
                        </div>
                        @if(session('alert'))
                            <div class="alert alert-success">{{session('alert')}}</div>
                        @endif
                        <div><button class="btn" type="submit">Gửi phản hồi</button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>Thông tin liên hệ</h2>
                    <h3><i class="fa fa-map-marker"></i>123 Cầu Giấy, Hà Nội</h3>
                    <h3><i class="fa fa-envelope"></i>huynq.rma@gmail.com</h3>
                    <h3><i class="fa fa-phone"></i>0394 366 374</h3>
                    <h3><i class="fab fa-facebook"></i><a href="https://www.facebook.com/hshoes189">H-Shoes</a></h3>
                    <h4>Thời gian hỗ trợ: 8h00-21h00</h4>
                    <!-- <div class="social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1862.0083773102558!2d105.79923653316276!3d21.032015598125106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab46cd173099%3A0x4a2779b1a457d467!2zMTIzIEPhuqd1IEdp4bqleSwgUXVhbiBIb2EsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1620374187036!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@stop