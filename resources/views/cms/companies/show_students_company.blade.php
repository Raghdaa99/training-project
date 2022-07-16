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

<body>

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


<br>
<br>
<br>
<br>
<section class="company-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- /.card -->

                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header  d-flex align-items-center justify-content-center">
                        <h3 class="card-title">تدريب ميداني</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="row"  style="direction: rtl; padding: 0 70px;font-size: 18px;">
                                <div class="col-12 text-right">
                                    <p>
                                        مؤسسة {{$item->companyField->company->name}} الموقرة
                                    </p>
                                    <p style="font-weight: bold">
                                       تحية طيبة وبعد ،،،
                                    </p>
                                </div>
                            </div>
                            <p class="card-text text-justify"
                               style="direction: rtl; padding: 40px 70px; padding-top:10px;line-height: 30px;font-size: 18px;">
                                نهديكم أطيب التحيات ، وأرجو العلم بأن الطالب/ة <u
                                    style="text-underline: auto"> {{$item->student->student->name}}</u> ،
                                الذي(التي) ت/يحمل الرقم الجامعي <u>{{$item->student_no}}</u>،
                                هو/هي احد/ى الطلبة/ات في تخصص <u>{{$item->student->student->department->name}}</u> ،
                                في كلية الحاسبات وتكنولوجيا المعلومات بجامعة الأقصى ،
                                ومن أجل استكمال متطلبات تخرجه/ا ،يجب أن ت/يكون قد أنهى /ت متطلبات مساق التدريب الميداني.
                                <br>
                                آمل موافقتكم بالسماح للطالب/ة المذكور/ة بالتدرب في مؤسستكم الموقرة في المجال
                                <u>{{$item->companyField->field->name}}</u> ما مدته<u> 120</u> ساعة تدريبية ،

                               علما بأنه سيلتزم بجميع الأنظمة والقوانين داخل المؤسسة .
                                <br>
                                <br>
                                <strong class="text-center">وتفضلوا بقبول فائق الاحترام والتقدير ،،،</strong>

                            </p>

                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="name">Student No</label>--}}
                            {{--                                <input type="text" class="form-control" id="name"--}}
                            {{--                                       name="name" value="{{$item->student_no}}" disabled>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="email">Student Name</label>--}}
                            {{--                                <input type="email" class="form-control" id="email"--}}
                            {{--                                       name="email" value="{{$item->student->student->name}}" disabled>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="email">Field Name</label>--}}
                            {{--                                <input type="email" class="form-control" id="email"--}}
                            {{--                                       name="email" value="{{$item->companyField->field->name}}" disabled>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="email">University Name</label>--}}
                            {{--                                <input type="email" class="form-control" id="email"--}}
                            {{--                                       name="email" value="Al-Aqsa University" disabled>--}}
                            {{--                            </div>--}}
                            <button type="button" onclick="performUpdate()"
                                    class="btn btn-success">
                                <i class="fas fa-check">
                                </i>
                                Accepted
                            </button>


                            <a class="btn btn-danger btn-sm" onclick="cancelRequest()">
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


</body>
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
            window.location.href = '/show/company/trainers/{{$item->slug()}}';
        })
            .catch(function (error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
    }

    function cancelRequest(){
        axios.put('/show/company/{{$item->id}}/update', {
            status: 0,
        }).then(function (response) {
            //2xx
            // console.log(response);
            // toastr.success(response.data.message);
            window.location.href = '/';
        })
            .catch(function (error) {
                //4xx - 5xx
                // console.log(error.response.data.message);
                // toastr.error(error.response.data.message);
            });
    }
</script>

{{--@endsection--}}
