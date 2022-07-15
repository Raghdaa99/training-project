
@extends('cms.auth.master')
@section('section')
    <div class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">

        <div class="card-body">
            <h1 class="h2 card-header text-center" id="yui_3_17_2_1_1657042721205_31">
                <span class="sr-only">بوابة التعليم الإلكتروني- جامعة الأقصى: Log in</span>
                <img src="https://moodle.alaqsa.edu.ps/pluginfile.php/1/core_admin/logo/0x200/1647336089/alaqsa_logo.png" class="img-fluid" alt="" id="yui_3_17_2_1_1657042721205_32">
            </h1>

            <div class="card-header text-center">
                <a href="" class="h1"><b>Register</b></a>
            </div>
            <form>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" id="name" value="{{$user->name}}" disabled>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <?php
                    $str = $guard."_no";
                    $guard_no =$user->$str ?>
                    <input type="text" class="form-control" placeholder="Student Number" id="number" value="{{$guard_no}}" disabled>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" id="name" value="{{$user->id_number}}" disabled>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Phone" id="phone" value="{{$user->phone}}" disabled>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" id="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <select class="custom-select form-control-border" id="department_no">
                        @foreach ($departments as $department)
                            <option value="{{$department->department_no}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="button" onclick="register()" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <a href="{{route('cms.login','student')}}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
    </div>
@endsection

@section('scripts')
    <script>
        function register() {

            axios.put('/cms/register', {
                number: document.getElementById('number').value,
                // name: document.getElementById('name').value,
                // phone: document.getElementById('phone').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                guard: '{{$guard}}',
                department_no: document.getElementById('department_no').value,

            })
                .then(function (response) {
                    toastr.success(response.data.message);
                    console.log(response);
                    window.location.href = '/cms/{{$guard}}/login';
                })
                .catch(function (error) {

                    toastr.error(error.response.data.message);
                    console.log(error.response.data.message);
                });
        }
    </script>
@endsection
