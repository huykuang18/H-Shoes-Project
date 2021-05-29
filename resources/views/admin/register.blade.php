<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tạo tài khoản | Admin Hshoes</title>
    <link href="{{asset('source/css/adstyle.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Đăng ký tài khoản quản trị viên</h3>
                                </div>
                                <div class="card-body">
                                    @if(session('alert'))
                                    <div class="alert alert-danger">{{session('alert')}}</div>
                                    @endif
                                    <form method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Họ và tên</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="text" name="fullname" placeholder="Nhập họ tên" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Số điện thoại</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="number" name="phone" placeholder="Nhập số điện thoại di động" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Tài khoản</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="text" name="username" placeholder="Nhập tài khoản" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Mật khẩu</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Xác nhận mật khẩu</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" name="repassword" placeholder="Nhập lại mật khẩu" required />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" required>
                                                <label class="custom-control-label" for="rememberPasswordCheck">Đồng ý với điều khoản & bảo mật</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Hoàn thành</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <img src="{{asset('source/img/logo.png')}}" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('source/js/scripts.js')}}"></script>
</body>

</html>