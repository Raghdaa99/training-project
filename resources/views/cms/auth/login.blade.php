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
        <div class="card-header text-center">
{{--            {{$guard}}--}}
            @if($guard == 'student')
                <a href="" class="h1"><b>Student Login</b></a>
            @elseif($guard == 'admin')
                <a href="" class="h1"><b>Admin Login</b></a>
            @elseif($guard == 'supervisor')
                <a href="" class="h1"><b>Supervisor Login</b></a>
            @elseif($guard == 'trainer')
                <a href="" class="h1"><b>Trainer Login</b></a>
            @endif
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

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


            <p class="mb-0">
                <a href="{{route('cms.register','student')}}" class="text-center">Register a new membership</a>
            </p>
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
                window.location.href = '/cms/admin/departments';
            })
            .catch(function (error) {

                toastr.error(error.response.data.message);
                console.log(error.response.data.message);
            });
    }
</script>
</body>

</html>
