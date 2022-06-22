@extends('cms.parent')

@section('title',__('cms.students'))

@section('styles')

@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name','Students')
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

                        @if(count($company_students)>0)
                            <div class="card-header">
                                <div class="header-elements position-relative">
                                    <form
                                        class="d-flex flex-wrap">
                                        @csrf
                                        <div class="form-group mb-0">
                                            <input type="text" name="student_no" id='student_no' class="form-control"
                                                   placeholder="Student Number" style="width: 250px"
                                                   @isset($search_student_no)
                                                   value="{{$search_student_no}}"
                                                @endisset
                                            >
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="text" name="student_name" id="student_name"
                                                   class="form-control"
                                                   placeholder="Student Name" style="width: 250px"
                                                   @isset($search_student_name)
                                                   value="{{$search_student_name}}"
                                                @endisset
                                            >
                                        </div>
                                        <div class="form-group mb-0">
                                            <select class="form-control" style="width:250px;" id="company_id">
                                                <option value="" selected="selected">All Companies</option>
                                                @foreach ($companies as $company)
                                                    <option
                                                        value="{{$company->id}}"
                                                        {{$search_company_id==$company->id?'selected':''}}
                                                    >{{$company->name}}

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-0">
                                            {{--                                            <button type="submit" class="btn btn-primary"><i--}}
                                            {{--                                                    class="icon-search4 mr-1"></i> Search--}}
                                            {{--                                            </button>--}}
                                            <button onclick="search()" type="button" class="btn btn-primary"><i
                                                    class="icon-search4 mr-1"></i> Search
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                    @endif
                    <!-- /.card-header -->
                        <div class="card-body">
                            @if(count($company_students)>0)

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
                                                    <a href="{{route('supervisor.show.students.details',$company_student->studentCompany->slug())}}"
                                                       class="btn btn-info btn-sm">
                                                        <i class="fas fa-table"> Show</i>
                                                    </a>


                                                </td>
                                            @else
                                                <td> No company</td>
                                                <td style="text-align:center" colspan="3">
                                                    <div class="btn-group">
                                                        {{--                                                    <a href="{{route('register.Student.Company',$company_student->student_no)}}"--}}
                                                        {{--                                                       class="btn btn-dark btn-bg">--}}
                                                        {{--                                                        <i class="fas fa-plus-circle"> Add Company</i>--}}
                                                        {{--                                                    </a>--}}
                                                        <a href="{{url('/cms/supervisor/registerCompany/?student_no='.$company_student->student_no)}}"
                                                           class="btn btn-dark btn-bg">
                                                            <i class="fas fa-plus-circle"> Add Company</i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @else
                                {{--                            <p style="align-content: center"></p>--}}
                                <br>
                                <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    No Students registered the course
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
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
        function search() {
            $student_no = document.getElementById('student_no').value;
            $student_name = document.getElementById('student_name').value;
            $company_id = document.getElementById('company_id').value;

            window.location.href ='/cms/supervisor/show/Students?student_no=' + $student_no + '&student_name=' + $student_name + '&company_id=' + $company_id;
        }

        function createCompany(student_no) {
            axios.get('/cms/supervisor/registerCompany/?student_no=' + student_no, {})
                .then(function (response) {
                    //2xx
                    console.log(response);
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                })
        }

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
