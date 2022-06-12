@extends('cms.parent')

@section('title','Evaluation')

@section('styles')

@endsection

@section('large-page-name',__('cms.create'))
@section('main-page-name',__('Evaluation'))
@section('small-page-name',__('cms.create'))

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Evaluation</h3>
                        </div>
                        @if($sum_mark != null)
                        @auth('supervisor')
                            <div class="card-body">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Evaluation of Trainer</h3>
                                </div>
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
                            </div>


                        @else
                            <br>

                                <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    No Evaluations yet from Trainer
                                </div>


                    @endif
                    @endauth
                        <!-- /.card-header -->
                        <div class="card-body">
                            @auth('trainer')
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Evaluation of Trainer</h3>
                                </div>
                                </div>
                            @endauth
                                @auth('supervisor')
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Evaluation of Supervisor</h3>
                                        </div>
                                    </div>
                                @endauth
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th> Elements Of Evaluation </th>
                                    <th>Max Mark</th>
                                    <th>Mark</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $question)
                                <tr>
                                    <input type="hidden" class="form-control" value="{{$question->id}}" name="question_id[]">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$question->title}}</td>
                                    <td>{{$question->max_mark}}</td>
                                    <input type="hidden" class="form-control" value="{{$question->max_mark}}" name="max_marks[]">
                                    <td>
                                        <input type="number" class="form-control" max="{{$question->max_mark}}" name="marks[]" id="marks[]" >
                                    </td>
                                </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
                                    class="btn btn-primary">{{__('cms.save')}}</button>
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


        function performStore() {
            var marks = [];
            $('input[name="marks[]"]').each(function(i, e) {
                marks.push($(this).val());
            });

            var max_marks = [];
            $('input[name="max_marks[]"]').each(function(i, e) {
                max_marks.push($(this).val());
            });

            var question_id = [];
            $('input[name="question_id[]"]').each(function(i, e) {
                question_id.push($(this).val());
            });
            axios.post('/cms/evaluations', {
                student_company_id: {{$student_company_id}},
                question_id:question_id,
                marks: marks,
                max_marks: max_marks,
            }).then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    // document.getElementById('create-form').reset();
                window.location.href = '/cms/student/evaluation/{{$student_company_id}}/show';
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
