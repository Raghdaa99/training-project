@extends('cms.parent')

@section('title',__('cms.students'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('large-page-name','Supervisor Name : '.auth()->user()->name)
@section('main-page-name','Students')
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
                            @if(count($company_students)>0)

                                <table class="table table-bordered table-striped table-hover" id="example">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Student No</th>
                                        <th>Student Name</th>
                                        <th>Company Name</th>
                                        <th>Trainer Name</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company_students as $student)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$student->student_no}}</td>
                                            <td>{{$student->student->name}}</td>
                                            <td>{{$student->studentCompany->companyField->company->name ?? ''}}</td>
                                            <td>{{$student->studentCompany->trainer->name??''}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @else
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
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        // function search() {
        //     // $student_no = document.getElementById('student_no').value;
        //     // $student_name = document.getElementById('student_name').value;
        //     $company_id = document.getElementById('company_id').value;
        //
        //     window.location.href = '/cms/supervisor/reports/student-evaluation-company?company_id=' + $company_id;
        // }

        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
