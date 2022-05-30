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
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($item != null)
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Student No</th>
                                        <td>{{$item->student_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>Student Name</th>
                                        <td>{{$item->student->student->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Company Name</th>
                                        <td>{{$item->companyField->company->name}}</td>

                                    </tr>
                                    <tr>
                                        <th>Field Name</th>
                                        <td>{{$item->companyField->field->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Supervisor</th>
                                        <td><span
                                                class="badge @if($item->status_supervisor) bg-success @else bg-danger @endif">{{$item->supervisor_status}}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        @if($item->status_supervisor==0)
                                            <th style="width: 30px">Settings</th>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('edit.Student.Company',$item->id)}}"
                                                       class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" onclick="confirmDelete('{{$item->id}}',this)"
                                                       class=" btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        @endif
                                    </tr>
                                    @if($item->status_company==1)
                                        <tr>
                                            {{--                                        <th style="width: 10px">#</th>--}}
                                            <th style="width: 60px">Appointments</th>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('show.student.appointment',$item->id)}}"
                                                       class="btn btn-warning">
                                                        <i class="fas fa-table"> Show</i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th style="width: 60px">Attendances</th>
                                            <td><a class="btn btn-secondary btn-sm"
                                                   href="{{route('show.student.attendances',$item->id)}}">
                                                    Attendance
                                                </a></td>
                                        </tr>

                                        <tr>
                                            <th style="width: 60px">Reports</th>
                                            <td><a class="btn btn-primary btn-sm"
                                                   href="{{route('create.report',$item->id)}}">
                                                    Repotrs
                                                </a></td>
                                        </tr>
                                    @endif
                                    </thead>


                                    <tbody>

                                    {{--                                    @foreach ($items as $item)--}}
                                    <tr>
                                        {{--                                            <td>{{$loop->iteration}}</td>--}}



                                        {{--                                        @if($item->status_supervisor==0)--}}
                                        {{--                                           --}}
                                        {{--                                        @endif--}}
{{--                                        @if($item->status_company==1)--}}

{{--                                           --}}
{{--                                        @endif--}}
                                    </tr>
                                    {{--                                    @endforeach--}}


                                    </tbody>
                                </table>
                            @else
                                <p> no company registerd</p>
                            @endif
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
        function confirmDelete(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    performDelete(id, reference);
                }
            });
        }

        function performDelete(id, reference) {

            axios.delete('/cms/student/registerStudentCompany/' + id)
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    reference.closest('table').remove();

                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
