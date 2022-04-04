@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')
    <link rel="stylesheet"
          href="{{asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('cms/plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section('large-page-name',__('cms.create'))
@section('main-page-name','Appointments')
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
                                    <label for="">Student Name</label>
                                    <select class="custom-select form-control-border" id="user_id">
                                        @foreach ($students as $student)
                                            <option value="{{$student->student_no}}">{{$student->student->student->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--Time picker -->
                                <div class="form-group">
                                    <label for="name">Number of Hours</label>
                                    <input type="number" class="form-control" id="age" placeholder="Enter number hours of Training"
                                           name="no_hours_of_training">
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm">
                                        <label>Start Date:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input id="date_appointment" type="text"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#reservationdate"/>
                                            <div class="input-group-append" data-target="#reservationdate"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label>End Date:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input id="date_appointment" type="text"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#reservationdate"/>
                                            <div class="input-group-append" data-target="#reservationdate"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="form-group col-sm">
                                        <label>Start Time:</label>

                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                            <input id="time_appointment" type="text"
                                                   class="form-control datetimepicker-input" data-target="#timepicker">
                                            <div class="input-group-append" data-target="#timepicker"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-sm">
                                        <label>End Time:</label>

                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                            <input id="time_appointment" type="text"
                                                   class="form-control datetimepicker-input" data-target="#timepicker">
                                            <div class="input-group-append" data-target="#timepicker"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                </div>


                                <label>Days of Training :</label>
                                <div class="form-group">

                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="" onclick="">
                                        <label for="">Saturday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="" onclick="">
                                        <label for="">Sunday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="" onclick="">
                                        <label for="">Monday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="" onclick="">
                                        <label for="">Tuesday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="" onclick="">
                                        <label for="">Wednesday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="" onclick="">
                                        <label for="">Thursday</label>
                                    </div>

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
    <script src="{{asset('cms/plugins/moment/moment.min.js')}}"></script>

    <script src="{{asset('cms/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script src="{{asset('cms/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        $(function () {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'HH:mm:ss'
            });

        });

        function performStore() {
            axios.post('/cms/admin/appointments', {
                user_id: document.getElementById('user_id').value,
                patient_id: document.getElementById('patient_id').value,
                date: document.getElementById('date_appointment').value,
                time: document.getElementById('time_appointment').value,
                emergency: document.getElementById('emergency').checked
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
