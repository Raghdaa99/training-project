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

@yield('section')


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

@yield('scripts')
</body>

</html>
