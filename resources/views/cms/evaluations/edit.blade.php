@extends('cms.parent')

@section('title','Evaluation')

@section('styles')

@endsection

@section('large-page-name',__('cms.update'))
@section('main-page-name',__('Evaluation'))
@section('small-page-name',__('cms.update'))

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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th> Elements Of Evaluation</th>
                                    <th>Max Mark</th>
                                    <th>Mark</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($evaluations as $evaluation)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$evaluation->question->title}}</td>
                                        <td>{{$evaluation->question->max_mark}}</td>
                                        <input type="hidden" class="form-control" value="{{$evaluation->question->id}}"
                                               name="question_id[]">
                                        <input type="hidden" class="form-control" value="{{$evaluation->question->max_mark}}" name="max_marks[]">

                                        <td>
                                            <input type="number" class="form-control" value="{{$evaluation->mark}}"
                                                   name="marks[]" id="marks[]">
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
            $('input[name="marks[]"]').each(function (i, e) {
                marks.push($(this).val());
            });
            var question_id = [];
            $('input[name="question_id[]"]').each(function (i, e) {
                question_id.push($(this).val());
            });
            var max_marks = [];
            $('input[name="max_marks[]"]').each(function(i, e) {
                max_marks.push($(this).val());
            });


            axios.put('/cms/student/evaluation/update', {
                student_company_id: '{{$student_company_id}}',
                max_marks: max_marks,
                question_id: question_id,
                marks: marks,
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
