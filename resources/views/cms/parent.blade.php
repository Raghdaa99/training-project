<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('cms/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->

            @if(auth()->check())
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('cms/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>

                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    </div>

                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        @auth('admin')
                        <li class="nav-item">
                            <a href="{{route('cms.admin.dashboard')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @endauth

                        @canany(['Create-Role','Read-Roles', 'Create-Permission','Read-Permissions'])
                        <li class="nav-header">{{__('cms.roles_permissions')}}</li>
                        @canany(['Create-Role','Read-Roles'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    {{__('cms.roles')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                @can('Read-Roles')
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Role')
                                <li class="nav-item">
                                    <a href="{{route('roles.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.create')}}</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @canany(['Create-Permission','Read-Permissions'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    {{__('cms.permissions')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                @can('Read-Permissions')
                                <li class="nav-item">
                                    <a href="{{route('permissions.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Permission')
                                <li class="nav-item">
                                    <a href="{{route('permissions.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.create')}}</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @endcanany

                        @canany(['Create-Admin','Read-Admins','Create-Student','Read-Users'])
                        <li class="nav-header">{{__('cms.hr')}}</li>
                        @canany(['Create-Admin','Read-Admins'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{__('cms.admins')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                @can('Read-Admins')
                                <li class="nav-item">
                                    <a href="{{route('admins.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Admin')
                                <li class="nav-item">
                                    <a href="{{route('admins.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.create')}}</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @canany(['Create-Supervisor','Read-Supervisors'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{__('cms.supervisors')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                @can('Read-Supervisors')
                                <li class="nav-item">
                                    <a href="{{route('supervisors.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
{{--                                @can('Create-Supervisor')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('supervisors.create')}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>{{__('cms.create')}}</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                @endcan--}}
                            </ul>
                        </li>
                        @endcanany
                        @canany(['Read-Students-Admin'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">

                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Students
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                @can('Read-Students-Admin')

                                <li class="nav-item">
                                    <a href="{{route('students.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
{{--                                @can('Create-Student')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('students.create')}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>{{__('cms.create')}}</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                @endcan--}}
                            </ul>
                        </li>
                        @endcanany
                        @endcanany

                        @canany(['Create-Department','Read-Departments','Create-Field','Read-Fields','Create-Company','Read-Companies'])
                        <li class="nav-header">{{__('cms.content_management')}}</li>
                        @canany(['Create-Department','Read-Departments'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{__('cms.departments')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Create-Department')
                                <li class="nav-item">
                                    <a href="{{route('departments.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Read-Departments')
                                <li class="nav-item">
                                    <a href="{{route('departments.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.create')}}</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Create-Field','Read-Fields'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{__('cms.fields')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Fields')
                                <li class="nav-item">
                                    <a href="{{route('fields.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Field')
                                <li class="nav-item">
                                    <a href="{{route('fields.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.create')}}</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Create-Company','Read-Companies'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{__('cms.company')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Companies')
                                <li class="nav-item">
                                    <a href="{{route('companies.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.index')}}</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Company')
                                <li class="nav-item">
                                    <a href="{{route('companies.create')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('cms.create')}}</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @endcanany

                        {{-- {{auth()->guard('student')->check()}}--}}

                        @can('Add-Data-Company')
                        <li class="nav-item">
                            <a href="{{route('register.Student.Company',auth()->user()->student_no)}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Add Company
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('Read-Data-Company')
                        <li class="nav-item">
                            <a href="{{route('registerStudentCompany.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Read Data
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('Registered-Students')
                        <li class="nav-item">
                            <a href="{{route('registerStudentCourse.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Registered Students
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">--}}
                        {{-- <a href="{{route('registerStudentCourse.create')}}" class="nav-link">--}}
                        {{-- <i class="nav-icon fas fa-th"></i>--}}
                        {{-- <p>--}}
                        {{-- Registered Students--}}
                        {{-- </p>--}}
                        {{-- </a>--}}
                        {{-- </li>--}}
                        @endcan


                        @can('Read-Students-Trainer')
                        <li class="nav-item">
                            <a href="{{route('trainers.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    index Students
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('Read-Students')
                        <li class="nav-item">
                            <a href="{{route('supervisor.show.students')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Read Students
                                </p>
                            </a>
                        </li>
                        @endcan

                        <li class="nav-header">{{__('cms.settings')}}</li>
                        <li class="nav-item">

                            <a href="{{route('cms.update.password')}}" class="nav-link">
                                <i class="nav-icon fas fa-lock"></i>
                                <p class="text">Update Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('cms.logout')}}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">{{__('cms.logout')}}</p>
                            </a>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->

            </div>
            @endif
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('large-page-name')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@yield('main-page-name')</a></li>
                                <li class="breadcrumb-item active">@yield('small-page-name')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @yield('scripts')

</body>

</html>
