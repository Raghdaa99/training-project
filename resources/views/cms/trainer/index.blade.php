@extends('cms.parent')

@section('title',__('cms.students'))

@section('styles')

@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name',__('cms.students'))
@section('small-page-name',__('cms.index'))

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Student No</th>
                                    <th>Student Name</th>
                                    <th>Field Name</th>

                                    <th>Settings</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$student->student_no}}</td>
                                        <td>{{$student->student->student->name}}</td>
                                        <td>{{$student->fields->name}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               onclick="confirmSendEmail('{{$student->id}}','{{$student->companies->email}}')">
{{--                                                <i class="fa fa-envelope"></i>--}}

                                               Create Appointment
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSendEmail($id, $email) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    sendEmail($id, $email);
                }
            });
        }

        function sendEmail($id, $email) {
            console.log($email);
            axios.post('/send/email/company', {
                email: $email,
                id: $id
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);

                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
