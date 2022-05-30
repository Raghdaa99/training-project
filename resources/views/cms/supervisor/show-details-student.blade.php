@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')
    <link rel="stylesheet"
          href="{{asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('cms/plugins/daterangepicker/daterangepicker.css')}}">
@endsection


@section('main-page-name','Students')
@section('small-page-name','Show')

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
                            <h3 class="card-title">Details</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="trainer_name">Student Name :</label>

                                    <span>   {{$company_student->student->student->name}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="trainer_name">Department Name :</label>

                                    <span>   {{$company_student->student->student->department->name}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="trainer_name">Send Email to Company:</label>
                                    <a class="btn btn-primary btn-sm"
                                       onclick="confirmSendEmail('{{$company_student->id}}','{{$company_student->companyField->company->email}}')">
                                        <i class="fa fa-envelope"></i>

                                        Send
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="trainer_name">Show Appointments :</label>
                                    <a href="{{route('show.student.appointment',$company_student->id)}}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-table"> Show</i>
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="trainer_name">Show Attendance :</label>
                                    <a class="btn btn-secondary btn-sm"
                                       href="{{route('show.student.attendances',$company_student->id)}}">
                                        Attendance
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="trainer_name">Evaluations from Trainer :</label>
                                    <a class="btn btn-info btn-sm"
                                       href="{{route('show.supervisor.evaluation.trainer',$company_student->id)}}"
                                    >
                                        Evaluations Trainer
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="trainer_name">Evaluations from Supervisor :</label>
                                    <a class="btn btn-success btn-sm"
                                       href="{{route('show.student.evaluation',$company_student->id)}}"
                                    >
                                        Evaluations Supervisor
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-body -->


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
    <script src="{{asset('cms/plugins/moment/moment.min.js')}}"></script>

    <script src="{{asset('cms/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script src="{{asset('cms/plugins/daterangepicker/daterangepicker.js')}}"></script>

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
