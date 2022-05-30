@extends('cms.parent')

@section('title','Reports')

@section('styles')

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{--                        @auth('student')--}}
                        {{--                            <div class="card-header">--}}
                        {{--                                <a onclick="RegisterAttendance()" class="btn btn-success">--}}
                        {{--                                    <i>Register Attends Student</i>--}}
                        {{--                                </a>--}}
                        {{--                            </d
                        {{--                    @endauth--}}
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
{{--                            <img src="uploads/{{ Session::get('file') }}">--}}
                            <a href="uploads/{{ Session::get('file') }}" target="_blank">Download Spec Sheet</a>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @auth('student')
                            <form action="{{route('reports.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <input type="file" name="file" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>

                                </div>
                            </form>
                    @endauth
                    <!-- /.card-header -->

                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>

                                    <th>Report</th>
                                    @auth('student')
                                        <th>Settings</th>
                                    @endauth
                                </tr>
                                </thead>
                                <tbody>
{{--                                @foreach ($reports as $report)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$loop->iteration}}</td>--}}
{{--                                        <td>{{$report->url}}</td>--}}
{{--                                        @auth('student')--}}
{{--                                            <td>--}}
{{--                                                <div class="btn-group">--}}
{{--                                                    <a href="#" onclick="confirmDelete('{{$report->id}}',this)"--}}
{{--                                                       class=" btn btn-danger">--}}
{{--                                                        <i class="fas fa-trash"> Delete</i>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                        @endauth--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}

                                </tbody>
                            </table>

                        </div>

                        <!-- /.card-body -->

                    </d>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>


        function performStore() {

            // console.log(document.getElementById('student_no').value);

            axios.post('/cms/student/registerStudentCompany', {

{{--                student_no: {{$student_no}},--}}
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    // document.getElementById('create-form').reset();
                    @auth('student')
                        window.location.href = '/cms/student/registerStudentCompany';
                    @endauth

                        @auth('supervisor')
                        window.location.href = '/cms/supervisor/show/Students';
                    @endauth

                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }


        function confirmDelete(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.value) {
                    console.log(id);
                    performDelete(id, reference);
                }
            });
        }

        function performDelete(id, reference) {
            console.log(id);
            axios.delete('/cms/attendances/' + id)
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    reference.closest('tr').remove();
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
