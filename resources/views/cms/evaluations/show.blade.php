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
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{session('message')}}
                    </div>
                @endif
                <div class="col-md-12">
                    @if(count($evaluations)>0)
{{--                        <form action="{{route('evaluations.destroy',$evaluations[0]->id)}}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
                            <a href="{{route('edit.student.evaluation',$evaluations[0]->student_company_id)}}" class="btn btn-warning"
                               style="width: 100px; ">
                                <i class="fas fa-edit"> Edit </i>
                            </a>

{{--                            <button class="btn btn-danger" type="submit"--}}
{{--                                    style="width: 100px; ">--}}
{{--                                <i class="fas fa-edit"> Delete </i>--}}
{{--                            </button>--}}
{{--                        </form>--}}

                    @endif

                    @if(count($evaluations)==0)
                        <a href="{{route('create.student.evaluation',$student_company_id)}}" class="btn btn-secondary"
                           style="width: 200px; ">
                            <i class="fas fa-plus-circle"> Create Evaluation</i>
                        </a>
                    @endif
                <!-- general form elements -->
                    @if(count($evaluations)>0)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Evaluation</h3>
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
                                    @foreach ($evaluations as $evaluation)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$evaluation->question->title}}</td>
                                            <td>{{$evaluation->question->max_mark}}</td>
                                            <td>{{$evaluation->mark}}</td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th style="width: 10px">Sum</th>
                                        <th></th>
                                        <th>{{$sum_max_mark}}</th>
                                        <th>{{$sum_mark}}</th>
                                    </tr>

                                    </tbody>
                                    {{--                                    @endif--}}


                                </table>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->


                        </div>
                    @else
                        {{--                            <p style="align-content: center"></p>--}}
                        <br>
                        @auth('trainer')
                        <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            No Evaluations yet from Trainer
                        </div>
                        @endauth
                            @auth('supervisor')
                                <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    No Evaluations yet from Supervisor
                                </div>
                        @endauth
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
