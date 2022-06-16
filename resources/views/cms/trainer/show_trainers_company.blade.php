{{--@extends('cms.parent')--}}

{{--@section('title',__('cms.company'))--}}

{{--@section('styles')--}}

{{--@endsection--}}

{{--@section('large-page-name',__('cms.index'))--}}
{{--@section('main-page-name',__('cms.company'))--}}
{{--@section('small-page-name',__('cms.index'))--}}

{{--@section('content')--}}
    <!DOCTYPE html>

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
    <link rel="stylesheet" href="{{asset('cms/home/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
    @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Start Upper bar -->
<div class="upper-bar">
    <div class="container">
        <div class="row justify-content-sm-between">
            <div class="col-xs-1 center-block" style="text-align:center;">
                <a href="{{route('home')}}" class="brand-link">
                    <img src="{{asset('cms/dist/img/logo-faculty.jpeg')}}" alt="Logo"
                         class="brand-image img-circle elevation-3">

                    <span class="brand-text font-weight-light" style="color: white"> Training System</span>
                </a>
            </div>
            <div class="col-xs-1 center-block" style="text-align:center;margin-top:15px">
                <span class="center-block">جامعة الاقصى</span>
                <i class="nav-icon fas fa-home"></i>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="trainer-section" style="margin-top: 50px">
    <div class="container">
        <h2 class="text-center">تسجيل بيانات المدرب </h2>
        <p class="section-description text-center">
        تقوم الشركة بتسجيل بيانات المدرب لكي يصبح قادر على الدخول الى النظام
            ومتابعة الاجراءات الخاصة بالطالب متل تسجيل مواعيد التدريب ، وتسجيل حضور وانصراف الطالب وتقييم أداء الطالب خلال مرحلة التدريب
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
{{--                        <a href="{{route('trainer.create',$student_company_id)}}" class="btn btn-info">--}}
{{--                            <i class="icon fas fa-plus-circle"> Create Trainer</i>--}}
{{--                        </a>--}}
                        <a onclick="RegisterTrainer()" class="btn btn-info">
                            <i class="icon fas fa-plus-circle"> Create Trainer</i>
                        </a>

                    </div>
                    <!-- /.card-header -->
                    @if(count($trainers)>0)
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <td style="text-align:center" colspan="4">
                                        <span style="font-weight: bold;font-size: 20px;padding: 12px"> Select The Trainer </span>

                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 40px">Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($trainers as $trainer)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="trainer_id"
                                                       value="{{$trainer->id}}" id="trainer_id">
                                            </div>
                                        </td>
                                        <td>{{$trainer->name}}</td>
                                        <td>{{$trainer->email}}</td>
                                        <td>{{$trainer->phone}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="card-footer">
                                <button type="button" onclick="performRegister()"
                                        class="btn btn-primary">{{__('cms.save')}}</button>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning alert-dismissible" style="margin:8%">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            No Trainers Added
                        </div>
                @endif
                <!-- /.card-body -->

                </div>
                <!-- /.col -->
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
{{--@endsection--}}

{{--@section('scripts')--}}

</body>
<!-- Start Footer -->
<div class="mt-auto">
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
                    <img class="brand-image img-circle elevation-3" src="{{asset('cms/home/img/logo.png')}}" alt=""
                         height="200px" width="200px"/>
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
</div>


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

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.6/dist/sweetalert2.all.min.js"
        integrity="sha256-Ry2q7Rf2s2TWPC2ddAg7eLmm7Am6S52743VTZRx9ENw=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css"/>
<script>



    function performRegister() {
        var trainer_id = $('input[type="radio"]:checked').val();
        axios.post('/trainer/store', {
            trainer_id: trainer_id,
            company_student_id: '{{$student_company_id}}',
        })
            .then(function (response) {
                //2xx
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/';

                // reference.closest('tr').remove();
            })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
    }
</script>


<script>
    function RegisterTrainer() {
        // Swal.fire({
        //     title: 'تسجيل بيانات المدرب',
        //     html:
        //         '<input id="swal-input1" class="swal2-input" placeholder="Trainer Name">' +
        //         '<input id="swal-input1" class="swal2-input" placeholder="Trainer Phone">' +
        //         '<input id="swal-input2" class="swal2-input" placeholder="Trainer Email">',
        //     focusConfirm: false,
        //     preConfirm: () => {
        //         return [
        //             document.getElementById('swal-input1').value,
        //             document.getElementById('swal-input2').value
        //         ]
        //     }
        // })

        Swal.fire({
            title: "تسجيل بيانات المدرب",
            html:
                '<input id="trainer-name" class="swal2-input" placeholder="Trainer Name">' +
                '<input id="trainer-phone" class="swal2-input" placeholder="Trainer Phone">' +
                '<input id="trainer-email" class="swal2-input" placeholder="Trainer Email">',
            focusConfirm: false,
        }).then(function (result) {
            if (result.value) {
                $name = $('#trainer-name').val();
                $phone = $('#trainer-phone').val();
                $email = $('#trainer-email').val();
                performStore($name, $phone,$email);

            }
        });
    }
    function performStore($name, $phone,$email) {
        console.log('555');
        axios.post('/trainer/store/new', {
            name: $name,
            email: $email,
            phone: $phone,
            company_student_id:{{$student_company_id}},
        })
            .then(function (response) {
                //2xx
                console.log(response);
                toastr.success(response.data.message);
                location.reload();
                // document.getElementById('create-form').reset();
{{--                window.location.href = '/show/company/trainers/{{$student_company_id}}';--}}

            })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
    }
</script>
{{--@endsection--}}
