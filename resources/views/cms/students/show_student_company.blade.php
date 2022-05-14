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
                            @if($item != null)
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
{{--                                        <th style="width: 10px">#</th>--}}
                                        <th>Student No</th>
                                        <th>Student Name</th>
                                        <th>Company Name</th>
                                        <th>Field Name</th>
                                        <th>Status Supervisor</th>
                                        @if($item->status_supervisor==0)
                                            <th style="width: 30px">Settings</th>
                                        @endif
                                        @if($item->status_company==1)
                                            <th style="width: 60px">Appointments</th>
                                            <th style="width: 60px">Attendances</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

{{--                                    @foreach ($items as $item)--}}
                                        <tr>
{{--                                            <td>{{$loop->iteration}}</td>--}}
                                            <td>{{$item->student_no}}</td>
                                            <td>{{$item->student->student->name}}</td>
                                            <td>{{$item->companyField->company->name}}</td>
                                            <td>{{$item->companyField->field->name}}</td>
                                            <td><span
                                                    class="badge @if($item->status_supervisor) bg-success @else bg-danger @endif">{{$item->supervisor_status}}</span>
                                            </td>
                                            @if($item->status_supervisor==0)
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
                                            @if($item->status_company==1)
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{route('show.student.appointment',$item->id)}}"
                                                           class="btn btn-warning">
                                                            <i class="fas fa-table"> Show</i>
                                                        </a>

                                                    </div>
                                                </td>
                                                <td><a class="btn btn-secondary btn-sm"
                                                       href="{{route('show.student.attendances',$item->id)}}">
                                                        Attendance
                                                    </a></td>
                                            @endif
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

            axios.delete('/cms/student/registerStudentCompany/'+id)
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
