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
                        <!-- /.card-header -->
                        <div class="card-body">
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
                                    <input type="hidden" class="form-control" value="{{$question->id}}" id="question_id[]">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$question->title}}</td>
                                    <td>{{$question->max_mark}}</td>
                                    <td>
                                        <input type="number" class="form-control" name="marks[]" id="marks[]" >
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
            // var marks = [];
            // $('.marks').each(function(i, e) {
            //     marks.push($(this).val());
            // });
            // var question_id = [];
            // $('.question_id').each(function(i, e) {
            //     question_id.push($(this).val());
            // });

            var questions = [];
            questions = $('input[name="question_id[]"]').map(function(){
                return this.value;
            }).get();
            // var marks = $('input[name="marks[]"]').map(function(){
            //     return this.value;
            // }).get();
            axios.post('/cms/evaluations', {
                student_company_id: {{$student_company_id}},
                question_id:questions,
                marks: marks,
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create-form').reset();
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
