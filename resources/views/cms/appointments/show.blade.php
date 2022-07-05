@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')
    <link rel="stylesheet"
          href="{{asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('cms/plugins/daterangepicker/daterangepicker.css')}}">
@endsection


@section('main-page-name','Appointments')
@section('small-page-name','Show')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{session('message')}}
                    </div>
                @endif
                <div class="col-md-12">
                    @if($appointment !== null)
{{--                        @if($guard == 'trainer')--}}
                        @auth('trainer')
                        <form action="{{route('appointments.destroy',$appointment->slug())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('appointments.edit',$appointment->slug())}}" class="btn btn-warning"
                               style="width: 100px; ">
                                <i class="fas fa-edit"> Edit </i>
                            </a>

                            <button class="btn btn-danger" type="submit"
                                    style="width: 100px; ">
                                <i class="fas fa-edit"> Delete </i>
                            </button>
                        </form>
                        @endauth

{{--                    @endif--}}

                    @endif
                        @auth('trainer')

                    @if($appointment === null)
                        <a href="{{route('create.student.appointment',$student_company_id)}}" class="btn btn-secondary"
                           style="width: 200px; ">
                            <i class="fas fa-plus-circle"> Create Appointment</i>
                        </a>
                    @endif
                        @endauth
                <!-- general form elements -->
                    @if($appointment !== null)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Appointments</h3>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->

                            <form id="create-form">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="trainer_name">Student Name :</label>
                                        <span>   {{$appointment->student->student->student->name}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="trainer_name">Trainer Name :</label>
                                        <span> {{$appointment->student->trainer->name}}</span>
                                    </div>
                                    <!--Time picker -->
                                    <div class="form-group">
                                        <label for="no_hours_of_training">Number of Hours :</label>
                                        <span> {{$appointment->no_hours_of_training}}</span>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm">
                                            <label>Start Date:</label>
                                            <span> {{$appointment->start_date}}</span>
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>End Date:</label>
                                            <span> {{$appointment->end_date}}</span>

                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="form-group col-sm">
                                            <label>Start Time:</label>
                                            <span> {{$appointment->start_time}}</span>


                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group col-sm">
                                            <label>End Time:</label>
                                            <span> {{$appointment->end_time}}</span>


                                            <!-- /.input group -->
                                        </div>

                                    </div>
                                    <label>Days of Training :</label>
                                    {{$appointment->saturday_status}}
                                    {{$appointment->sunday_status}}
                                    {{$appointment->monday_status}}
                                    {{$appointment->tuesday_status}}
                                    {{$appointment->wednesday_status}}
                                    {{$appointment->thursday_status}}


                                </div>
                                <!-- /.card-body -->


                            </form>

                        </div>
                    @else
                        {{--                            <p style="align-content: center"></p>--}}
                        <br>
                        <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            No Appointments yet from Trainer
                        </div>
                @endif


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


@endsection
