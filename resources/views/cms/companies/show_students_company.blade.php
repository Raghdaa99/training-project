{{--@extends('cms.parent')--}}

{{--@section('title',__('cms.students'))--}}

{{--@section('styles')--}}

{{--@endsection--}}

{{--@section('large-page-name',__('cms.index'))--}}
{{--@section('main-page-name',__('cms.students'))--}}
{{--@section('small-page-name',__('cms.index'))--}}
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
                            <h3 class="card-title">Student</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Student No</label>
                                    <input type="text" class="form-control" id="name"
                                           name="name" value="{{$item->student_no}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Student Name</label>
                                    <input type="email" class="form-control" id="email"
                                           name="email" value="{{$item->student->student->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Field Name</label>
                                    <input type="email" class="form-control" id="email"
                                           name="email" value="{{$item->companyField->field->name}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">University Name</label>
                                    <input type="email" class="form-control" id="email"
                                           name="email" value="Al-Aqsa University" disabled>
                                </div>
                                <button type="button" onclick="performUpdate()"
                                        class="btn btn-success">
                                    <i class="fas fa-check">
                                    </i>
                                    Accepted
                                </button>


                                <a class="btn btn-danger btn-sm" href="">
                                    <i class="fas fa-times">
                                    </i>
                                    Cancel
                                </a>
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
    function performUpdate() {
        axios.put('/show/company/{{$item->id}}/update', {
            status: 1,
        }).then(function (response) {
            //2xx
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/show/company/trainers/{{$item->id}}';
        })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
    }
</script>
{{--@endsection--}}
