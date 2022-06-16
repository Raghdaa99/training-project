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
                            <table class="table table-bordered table-striped table-hover">
                                @if(count($students)>0)
                                    <thead>
                                    <tr>
                                        <th>Academic Number</th>
                                        <th>{{__('cms.name')}}</th>
                                        <th>Phone</th>
                                        <th>Id Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{$student->student_no}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->phone}}</td>
                                            <td>{{$student->id_number}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                @else
                                    <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                        No Students
                                    </div>
                                @endif
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


