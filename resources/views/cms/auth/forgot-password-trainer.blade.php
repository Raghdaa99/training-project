@extends('cms.auth.master')
@section('section')

    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <h1 class="h2 card-header text-center" id="yui_3_17_2_1_1657042721205_31">
                    <span class="sr-only">بوابة التعليم الإلكتروني- جامعة الأقصى: Log in</span>
                    <img
                        src="https://moodle.alaqsa.edu.ps/pluginfile.php/1/core_admin/logo/0x200/1647336089/alaqsa_logo.png"
                        class="img-fluid" alt="" id="yui_3_17_2_1_1657042721205_32">
                </h1>
                <div class="card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                    <form  method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" id="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" onclick="requestPassword()" class="btn btn-primary btn-block">Request new password</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mt-3 mb-1">
                        <a href="{{route('cms.login',$guard)}}">Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
    <!-- /.login-box -->
@endsection

@section('scripts')
    <script>
        function requestPassword() {
            var email = document.getElementById('email').value;
            axios.post('/cms/forget_password_trainer', {
                email: email,
                guard: '{{$guard}}',
            })
                .then(function (response) {
                    toastr.success(response.data.message);
                    console.log(response);
                    {{--window.location.href = '/cms/{{$guard}}/login';--}}
                })
                .catch(function (error) {

                    toastr.error(error.response.data.message);
                    console.log(error.response.data.message);
                });
        }
    </script>
@endsection

