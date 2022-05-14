@extends('cms.parent')

@section('title',__('cms.company'))

@section('styles')
    <style>
        .swal2-overflow {
            overflow-x: visible;
            overflow-y: visible;
        }
    </style>

@endsection

{{--@section('large-page-name',__('cms.index'))--}}
{{--@section('main-page-name',__('cms.company'))--}}
{{--@section('small-page-name',__('cms.index'))--}}

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @auth('trainer')
                            <div class="card-header">
                                <a onclick="RegisterAttendance()" class="btn btn-success">
                                    <i>Register Attends Student</i>
                                </a>
                            </div>
                        @endauth
                    <!-- /.card-header -->

                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    @auth('trainer')
                                        <th>Settings</th>
                                    @endauth
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$attendance->day_attendance}}</td>
                                        <td>{{$attendance->date_attendance}}</td>
                                        <td>{{$attendance->time_attendance}}</td>
                                        @auth('trainer')
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" onclick="confirmDelete('{{$attendance->id}}',this)"
                                                       class=" btn btn-danger">
                                                        <i class="fas fa-trash"> Delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        @endauth
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>

                        <!-- /.card-body -->

                    </div>
                    <!-- /.col -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.6/dist/sweetalert2.all.min.js"
            integrity="sha256-Ry2q7Rf2s2TWPC2ddAg7eLmm7Am6S52743VTZRx9ENw=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/start/jquery-ui.css"/>
    {{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
    <script>

        function RegisterAttendance() {
            Swal.fire({
                title: "Register Student",
                html:
                // '<input id="dayAttendance" class="swal2-input" placeholder="Enter Day">' +
                    '<input id="datetimepicker" class="form-control" placeholder="Enter Date" autofocus>',
                onOpen: function () {
                    $('#datetimepicker').datepicker({
                        dateFormat: 'dd-mm-yy',
                        // defaultDate: new Date()
                    });
                }
            }).then(function (result) {
                if (result.value) {
                    $day = $('#dayAttendance').val();
                    $date = $('#datetimepicker').val();
                    storeRegisterAttendance($day, $date);
                    location.reload();
                    // alert($('#datetimepicker').val());
                }
            });
        }

        function storeRegisterAttendance($day, $date) {
            axios.post('/cms/attendances', {
                student_company_id: {{$student_company_id}},
                date_attendance: $date,
                day_attendance: $day,

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
