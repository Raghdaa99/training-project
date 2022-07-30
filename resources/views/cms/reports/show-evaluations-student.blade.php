@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')
    <link rel="stylesheet"
          href="{{asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('cms/plugins/daterangepicker/daterangepicker.css')}}">
@endsection


@section('main-page-name','Evaluation')
@section('small-page-name','Show')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"> Student Name: {{$student_name}}</p>
                            <p class="card-text"> Final Mark: {{$finalMark}}</p>
                        </div>
                    </div>
                    <!-- general form elements -->
                    @if(count($evaluationsTrainer)>0)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Evaluation Trainer</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title Question</th>
                                        <th>Max OF Mark</th>
                                        <th>Mark</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                    <tbody>
                                    @foreach ($evaluationsTrainer as $evaluation)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$evaluation->question->title}}</td>
                                            <td>{{$evaluation->question->max_mark}}</td>
                                            <td>{{$evaluation->mark}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th style="width: 10px;text-align:center" colspan="2">Sum</th>
                                        <th>{{$evaluation->question->getTotalMarksOfTrainer()}}</th>
                                        <th>{{$trainerMark}}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                        </div>
                    @else
                        <br>
                        <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            No Evaluations yet from Trainer
                        </div>
                    @endif



                    @if(count($evaluationsSupervisor)>0)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Evaluation Supervisor</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title Question</th>
                                        <th>Max OF Mark</th>
                                        <th>Mark</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                    <tbody>
                                    @foreach ($evaluationsSupervisor as $evaluation)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$evaluation->question->title}}</td>
                                            <td>{{$evaluation->question->max_mark}}</td>
                                            <td>{{$evaluation->mark}}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th style="width: 10px;text-align:center" colspan="2">Sum</th>
                                        <th>{{$evaluation->question->getTotalMarksOfSupervisor()}}</th>
                                        <th>{{$supervisorMark}}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                        </div>
                    @else
                        <br>
                        <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            No Evaluations yet from Supervisor
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
