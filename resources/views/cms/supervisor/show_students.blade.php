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
            <!-- SidebarSearch Form -->
            {{--            <div class="row align-content-center">--}}
            {{--                --}}
            {{--            </div>--}}
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-inline">
                                <form action="{{route('supervisor.search.students')}}" method="post">
                                    @csrf

                                    <div class="input-group">
                                        <input type="text" class="form-control-sidebar" placeholder='Search Keyword'
                                               name="search" aria-label="Search"
                                               onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = 'Search Keyword'" required>
                                        <button class="btn btn-sidebar btn-primary" type="submit">
                                            <i class="fas fa-search fa-fw"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Student No</th>
                                    <th>Student Name</th>
{{--                                    <th>Department Name</th>--}}
                                    <th>Company Name</th>
                                    <th>Company Approved</th>
                                    <th>Supervisor Approved</th>
                                    <th>Settings</th>
                                    {{--                                    @if($students[0]->status==1)--}}
                                    {{--                                        <th style="width: 60px">Appointments</th>--}}
                                    {{--                                    @endif--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($company_students as $company_student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$company_student->student_no}}</td>
                                        <td>{{$company_student->student->name}}</td>
{{--                                        <td>{{$company_student->student->department->name}}</td>--}}
                                        {{--                                        <td>{{$company_student->companyField->company->name}}</td>--}}
                                        @if($company_student->studentCompany != null)
                                            <td>{{$company_student->studentCompany->companyField->company->name }}</td>


                                            <td><span
                                                    class="badge @if($company_student->studentCompany->status_company) bg-success @else bg-danger @endif">{{$company_student->studentCompany->company_status}}</span>
                                            </td>
                                            <td>
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox"
                                                           id="student_company_{{$company_student->studentCompany->id}}"
                                                           @if($company_student->studentCompany->status_supervisor)
                                                           checked @endif
                                                           onclick="updateStatusCompany('{{$company_student->studentCompany->id}}')">
                                                    <label
                                                        for="student_company_{{$company_student->studentCompany->id}}">Approved</label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route('supervisor.show.students.details',$company_student->studentCompany->id)}}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-table"> Show</i>
                                                </a>
{{--                                                <a class="btn btn-primary btn-sm"--}}
{{--                                                   onclick="confirmSendEmail('{{$company_student->studentCompany->id}}','{{$company_student->studentCompany->companyField->company->email}}')">--}}
{{--                                                    <i class="fa fa-envelope"></i>--}}

{{--                                                    Send Email to Company--}}
{{--                                                </a>--}}
                                                @if($company_student->studentCompany->status_company==1)
                                                    <div class="btn-group">

{{--                                                        <a href="{{route('show.student.appointment',$company_student->studentCompany->id)}}"--}}
{{--                                                           class="btn btn-warning btn-sm">--}}
{{--                                                            <i class="fas fa-table"> Show Appointments</i>--}}
{{--                                                        </a>--}}
{{--                                                        <a class="btn btn-secondary btn-sm"--}}
{{--                                                           href="{{route('show.student.attendances',$company_student->studentCompany->id)}}">--}}
{{--                                                            Attendance--}}
{{--                                                        </a>--}}
{{--                                                        <a class="btn btn-success btn-sm"--}}
{{--                                                           href="{{route('show.student.evaluation',$company_student->studentCompany->id)}}"--}}
{{--                                                        >--}}
{{--                                                            Evaluations--}}
{{--                                                        </a>--}}
{{--                                                        <a class="btn btn-info btn-sm"--}}
{{--                                                           href="{{route('show.supervisor.evaluation.trainer',$company_student->studentCompany->id)}}"--}}
{{--                                                        >--}}
{{--                                                            Evaluations from Trainer--}}
{{--                                                        </a>--}}
                                                    </div>
                                                @endif
                                            </td>
                                        @else
                                            <td> No company</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('register.Student.Company',$company_student->student_no)}}"
                                                       class="btn btn-dark btn-sm">
                                                        <i class="fas fa-plus-circle"> Add Company</i>
                                                    </a>
                                                </div>
                                            </td>
                                        @endif

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
        function updateStatusCompany(id) {
            axios.post('/cms/supervisor/update-supervisor-status', {
                'id': id,
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
                })
        }

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
