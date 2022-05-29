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
                    @if($evaluations !== null)
{{--                        {{route('appointments.destroy',$appointment->id)}}--}}

                        <form action="" method="POST">
{{--                            {{route('appointments.edit',$appointment)}}--}}
                            @csrf
                            @method('DELETE')
                            <a href="" class="btn btn-warning"
                               style="width: 100px; ">
                                <i class="fas fa-edit"> Edit </i>
                            </a>

                            <button class="btn btn-danger" type="submit"
                                    style="width: 100px; ">
                                <i class="fas fa-edit"> Delete </i>
                            </button>
                        </form>

                    @endif

{{--                    @if($evaluations === null)--}}
{{--                            {{route('create.student.appointment',$student_company_id)}}--}}
                        <a href="{{route('create.student.evaluation',$student_company_id)}}" class="btn btn-secondary"
                           style="width: 200px; " >
                            <i class="fas fa-plus-circle"> Create Evaluation</i>
                        </a>
{{--                    @endif--}}
                <!-- general form elements -->
                    @if($evaluations !== null)
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Evaluation</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{__('cms.name')}}</th>
                                        <th>{{__('cms.guard')}}</th>
                                        <th>Max OF Mark</th>
                                        <th style="width: 40px">Settings</th>
                                    </tr>
                                    </thead>
{{--                                    @if($questions == null)--}}

                                        <tbody>
                                        <tr>
                                            No Questions Added

                                        </tr>
                                        </tbody>

{{--                                    @elseif($questions ==! null)--}}
                                        <tbody>
{{--                                        @foreach ($questions as $question)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$question->id}}</td>--}}
{{--                                                <td>{{$question->title}}</td>--}}
{{--                                                <td>{{$question->guard}}</td>--}}
{{--                                                <td>{{$question->max_mark}}</td>--}}
{{--                                               --}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}

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
                        <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                            No Appointments yet from Trainer
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
