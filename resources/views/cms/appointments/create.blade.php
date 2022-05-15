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
{{--                                <div class="form-group">--}}
{{--                                    <label for="">Student Name</label>--}}
{{--                                    <select class="custom-select form-control-border" id="student_company_id">--}}
{{--                                        @foreach ($students as $student)--}}
{{--                                            <option value="{{$student->id}}">{{$student->student->student->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}

                                <!--Time picker -->
                                <div class="form-group">
                                    <label for="no_hours_of_training">Number of Hours</label>
                                    <input type="number" class="form-control" id="no_hours_of_training" placeholder="Enter number hours of Training"
                                           name="no_hours_of_training">
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm">
                                        <label>Start Date:</label>
                                        <div class="input-group date" id="start_date" data-target-input="nearest">
                                            <input id="start_date_appointment" type="text"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#start_date"/>
                                            <div class="input-group-append" data-target="#start_date"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm">
                                        <label>End Date:</label>
                                        <div class="input-group date" id="end_date" data-target-input="nearest">
                                            <input id="end_date_appointment" type="text"
                                                   class="form-control datetimepicker-input"
                                                   data-target="#end_date"/>
                                            <div class="input-group-append" data-target="#end_date"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="form-group col-sm">
                                        <label>Start Time:</label>

                                        <div class="input-group date" id="start_time" data-target-input="nearest">
                                            <input id="start_time_appointment" type="text"
                                                   class="form-control datetimepicker-input" data-target="#start_time">
                                            <div class="input-group-append" data-target="#start_time"
                                                 data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group col-sm">
                                        <label>End Time:</label>

                                        <div class="input-group date" id="end_time" data-target-input="nearest">
                                            <input id="end_time_appointment" type="text"
                                                   class="form-control datetimepicker-input" data-target="#end_time">
                                            <div class="input-group-append" data-target="#end_time"
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
                                        <input type="checkbox" id="Saturday">
                                        <label for="Saturday">Saturday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="Sunday">
                                        <label for="Sunday">Sunday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="Monday">
                                        <label for="Monday">Monday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="Tuesday">
                                        <label for="Tuesday">Tuesday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="Wednesday">
                                        <label for="Wednesday">Wednesday</label>
                                    </div>
                                    <div class="icheck-success d-block">
                                        <input type="checkbox" id="Thursday">
                                        <label for="Thursday">Thursday</label>
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
            $('#start_date').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $('#end_date').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            //Timepicker
            $('#start_time').datetimepicker({
                format: 'HH:mm:ss'
            });
            $('#end_time').datetimepicker({
                format: 'HH:mm:ss'
            });

        });

        function performStore() {
            axios.post('/cms/appointments', {
                student_company_id: {{$student_company_id}},
                no_hours_of_training: document.getElementById('no_hours_of_training').value,
                start_date: document.getElementById('start_date_appointment').value,
                end_date: document.getElementById('end_date_appointment').value,
                start_time: document.getElementById('start_time_appointment').value,
                end_time: document.getElementById('end_time_appointment').value,
                Saturday: document.getElementById('Saturday').checked,
                Sunday: document.getElementById('Sunday').checked,
                Monday: document.getElementById('Monday').checked,
                Tuesday: document.getElementById('Tuesday').checked,
                Wednesday: document.getElementById('Wednesday').checked,
                Thursday: document.getElementById('Thursday').checked,
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
