@extends('cms.parent')

@section('title',__('cms.update'))

@section('styles')

@endsection

@section('large-page-name',__('cms.update'))
@section('main-page-name',__('cms.departments'))
@section('small-page-name',__('cms.update'))

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('cms.update')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">{{__('cms.department_name')}}</label>
                                    <input type="text" class="form-control" id="name" placeholder="{{__('cms.department_name')}}"
                                           name="name" value="{{$department->name}}">
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="department_no">{{__('cms.department_no')}}</label>--}}
{{--                                    <input type="text" class="form-control" id="department_no" placeholder="{{__('cms.department_no')}}"--}}
{{--                                           name="department_no" value="{{$department->department_no}}">--}}
{{--                                </div>--}}
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate()"
                                        class="btn btn-primary">{{__('cms.save')}}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        function performUpdate() {
            axios.put('/cms/admin/departments/{{$department->department_no}}', {
                name: document.getElementById('name').value,
                department_no: {{$department->department_no}},
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/cms/admin/departments';
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
