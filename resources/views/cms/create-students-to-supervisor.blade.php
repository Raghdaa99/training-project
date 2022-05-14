@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')

@endsection

@section('large-page-name',__('cms.create'))
@section('main-page-name',__('cms.admins'))
@section('small-page-name',__('cms.create'))

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
                            <h3 class="card-title">{{__('cms.create')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="supervisor_no">Supervisors</label>
                                    <select class="custom-select form-control-border" id="supervisor_no">
                                        @foreach ($supervisors as $supervisor)
                                            <option
                                                value="{{$supervisor->supervisor_no}}">{{$supervisor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_no">Students</label>
                                    <select class="custom-select form-control-border" id="student_no">
                                        @foreach ($students as $student)
                                            <option value="{{$student->student_no}}">{{$student->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performStore()"
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
        function performStore() {
            axios.post('/cms/admin/registerStudentCourse', {
                supervisor_no: document.getElementById('supervisor_no').value,
                student_no: document.getElementById('student_no').value,

            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create-form').reset();
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
