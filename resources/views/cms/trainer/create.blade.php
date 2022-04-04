<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('cms.app_name')}} | Company</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a href="index3.html" class="brand-link">
                <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Alaqsa University</span>
            </a>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- /.card -->

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Trainer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Trainer Name</label>
                                    <input type="text" class="form-control" id="name"
                                           name="name" value="" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Trainer Phone</label>
                                    <input type="text" class="form-control" id="phone"
                                           name="phone" value="" placeholder="Enter your Phone">
                                </div>
                                <div class="form-group">
                                    <label for="email">Trainer Email</label>
                                    <input type="email" class="form-control" id="email"
                                           name="email" value="" placeholder="Enter your Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Trainer Password</label>
                                    <input type="password" class="form-control" id="password"
                                           name="password" value="" placeholder="Enter Password">
                                </div>
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()"
                                            class="btn btn-primary">{{__('cms.save')}}</button>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main Footer -->

</div>
</body>
<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function performStore() {
        axios.post('/trainer/store', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            phone: document.getElementById('phone').value,
            company_id:{{$company_id}},
        })
            .then(function (response) {
                //2xx
                console.log(response);
                toastr.success(response.data.message);
                // document.getElementById('create-form').reset();
                window.location.href = '/cms/trainer/login';

            })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
    }
</script>
{{--@endsection--}}
