@extends('cms.auth.master')
@section('section')
    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">

                <h1 class="h2 card-header text-center" id="yui_3_17_2_1_1657042721205_31">
                    <span class="sr-only">بوابة التعليم الإلكتروني- جامعة الأقصى: Log in</span>
                    <img
                        src="https://moodle.alaqsa.edu.ps/pluginfile.php/1/core_admin/logo/0x200/1647336089/alaqsa_logo.png"
                        class="img-fluid" alt="" id="yui_3_17_2_1_1657042721205_32">
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
                                @if($guard == 'student' || $guard == 'supervisor')
                                    <p class="mb-1">
                                        <a href="{{route('forget.password',$guard)}}">I forgot my password</a>
                                    </p>
                                @endif
                                @if($guard == 'trainer')
                                    <p class="mb-1">
                                        <a href="{{route('forget.password.trainer',$guard)}}">I forgot my password</a>
                                    </p>
                                @endif
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="button" onclick="login()" class="btn btn-primary btn-block">Sign In
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    @if($guard == 'student' || $guard == 'supervisor')
                        <p class="mb-0">
                            <a href="{{route('cms.check.credentials',$guard)}}" class="text-center">Register a new
                                membership</a>
                        </p>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
@endsection



@section('scripts')
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
@endsection
