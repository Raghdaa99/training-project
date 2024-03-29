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

                <div class="card-body">
                    <p class="login-box-msg"><b>Recover Password</b></p>
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
                            <div class="col">
                                <button type="button" onclick="requestPassword()" class="btn btn-primary btn-block">
                                    Request Password
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mt-3 mb-1">
                        <a href="{{route('cms.login',$guard)}}">Login</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection

@section('scripts')
    <script>
        function requestPassword() {
            var academic_number = document.getElementById('number').value;
            var id_number = document.getElementById('id_number').value;
            axios.post('/cms/forget_password', {
                academic_number: academic_number,
                id_number: id_number,
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
