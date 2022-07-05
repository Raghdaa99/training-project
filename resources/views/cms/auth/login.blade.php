<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('cms/home/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('cms/home/css/aos.css')}}" type="text/css">
</head>

<body>
<div class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">

            <h1 class="h2 card-header text-center" id="yui_3_17_2_1_1657042721205_31">
                <span class="sr-only">بوابة التعليم الإلكتروني- جامعة الأقصى: Log in</span>
                <img src="https://moodle.alaqsa.edu.ps/pluginfile.php/1/core_admin/logo/0x200/1647336089/alaqsa_logo.png" class="img-fluid" alt="" id="yui_3_17_2_1_1657042721205_32">
            </h1>
            <div class="card-header text-center">
                {{--            {{$guard}}--}}
                @if($guard == 'student')
                    <a href="" class="h3"><b>Student Login</b></a>
                @elseif($guard == 'admin')
                    <a href="" class="h3"><b>Admin Login</b></a>
                @elseif($guard == 'supervisor')
                    <a href="" class="h3"><b>Supervisor Login</b></a>
                @elseif($guard == 'trainer')
                    <a href="" class="h3"><b>Trainer Login</b></a>
                @endif
            </div>
            <div class="card-body">

                <form>
                    @if($guard == 'trainer')
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" id="number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Number" id="number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="button" onclick="login()" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                @if($guard == 'student' || $guard == 'supervisor')
                    <p class="mb-0">
                        <a href="{{route('cms.check.credentials',$guard)}}" class="text-center">Register a new membership</a>
                    </p>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>



<!-- Start Footer -->
<div class="footer">
    <div class="container">
        <div class="row">


            <div class="col-md-4">
                <div class="contact">
                    <h2>بيانات الاتصال</h2>
                    <ul class="list-unstyled">
                        <li>غزة - فلسطين</li>
                        <li>هاتف : +970-8-2882840</li>
                        <li>فاكس : +970-8-2882840</li>
                        <li>البريد الإلكتروني : edu@alaqsa.edu.ps</li>

                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact">
                    <h2>أقسام الكلية</h2>
                    <ul class="list-unstyled">
                        <li>قسم علوم الحاسوب والمعلومات</li>
                        <li>قسم الشبكات والهواتف النقالة</li>
                        <li>قسم تكنولوجيا المعلومات التطبيقية</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <img class="brand-image img-circle elevation-3" src="{{asset('cms/home/img/logo.png')}}" alt="" height="200px" width="200px"/>
            </div>
        </div>
    </div>
</div>
<!-- End Footer-->

<!--Start CopyRight -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col text-left">
                COPYRIGHT 2022 &copy; ALL RIGHTS RESERVED
            </div>
            <div class="col text-right">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Toastr -->
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

<script>
    function login() {

        axios.post('/cms/login', {
            number: document.getElementById('number').value,
            password: document.getElementById('password').value,
            remember: document.getElementById('remember').checked,
            // email: document.getElementById('email').checked,
            guard: '{{$guard}}',
        })
            .then(function (response) {
                toastr.success(response.data.message);
                console.log(response);
                window.location.href = '/cms/admin';
            })
            .catch(function (error) {

                toastr.error(error.response.data.message);
                console.log(error.response.data.message);
            });
    }
</script>
</body>

</html>
