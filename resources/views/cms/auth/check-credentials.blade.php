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
</head>

<body class="hold-transition login-page">
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
                <a href="" class="h3"><b>Student </b></a>
            @elseif($guard == 'admin')
                <a href="" class="h3"><b>Admin </b></a>
            @elseif($guard == 'supervisor')
                <a href="" class="h3"><b>Supervisor </b></a>
            @elseif($guard == 'trainer')
                <a href="" class="h3"><b>Trainer </b></a>
            @endif
        </div>
        <div class="card-body">
            <p class="login-box-msg">Check Your Credentials</p>
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Academic Number" id="number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="ID Number" id="id_number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="button" onclick="checkCredentials()" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

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
    function checkCredentials() {
        var academic_number = document.getElementById('number').value;
        var id_number =  document.getElementById('id_number').value;
        axios.post('/cms/check', {
            academic_number: academic_number,
            id_number: id_number,
            guard: '{{$guard}}',
        })
            .then(function (response) {
                // toastr.success(response.data.message);
                console.log(response);
                window.location.href = '/cms/{{$guard}}/register?academic_number='+academic_number+'&id_number='+id_number;
            })
            .catch(function (error) {

                toastr.error(error.response.data.message);
                console.log(error.response.data.message);
            });
    }
</script>
</body>

</html>
