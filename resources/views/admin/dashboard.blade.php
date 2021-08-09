@extends('admin.layout.main')
@section('title','Dashboard')
@section('content')
@if(session('alert'))
<script>
    alert("{{session('alert')}}");
    location = '/admin';
</script>
@endif
<div class="container-fluid">
    <h1 class="mt-4"></h1>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area mr-1"></i>
                    Thống kê bán theo nhãn hàng
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" max-height="50%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nhãn hiệu</th>
                                    <th>Số lượng bán</th>
                                    <th>Số tiền thu về</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nhãn hiệu</th>
                                    <th>Số lượng bán</th>
                                    <th>Số tiền thu về</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <td><img src="{{asset('source/img/brands/'.$brand->logo)}}" alt="image product">&nbsp;{{$brand->name}}</td>
                                    <td>{{$brand->quantity}}</td>
                                    <td>{{number_format($brand->total)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Thống kê bán hàng theo tháng
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" max-height="50%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tháng</th>
                                    <th>Số lượng bán</th>
                                    <th>Số tiền thu về</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tháng</th>
                                    <th>Số lượng bán</th>
                                    <th>Số tiền thu về</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($months as $month)
                                <tr>
                                    <td>Tháng {{$month->month}}</td>
                                    <td>{{$month->quantity}}</td>
                                    <td>{{number_format($month->total)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Danh sách khách hàng
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Số lượt mua hàng</th>
                            <th>Thời gian mua hàng gần nhất</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Số lượt mua hàng</th>
                            <th>Thời gian mua hàng gần nhất</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->purchased}}</td>
                            <td>{{$customer->updated_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection