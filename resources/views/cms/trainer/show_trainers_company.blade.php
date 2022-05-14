@extends('cms.parent')

@section('title',__('cms.company'))

@section('styles')

@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name',__('cms.company'))
@section('small-page-name',__('cms.index'))

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('trainer.create',$student_company_id)}}" class="btn btn-success">
                                <i>Create Trainer</i>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        @if(count($trainers)>0)
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 40px">Select</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($trainers as $trainer)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="trainer_id"
                                                       value="{{$trainer->id}}" id="trainer_id">
                                            </div>
                                        </td>
                                        <td>{{$trainer->name}}</td>
                                        <td>{{$trainer->email}}</td>
                                        <td>{{$trainer->phone}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="card-footer">
                                <button type="button" onclick="performRegister()"
                                        class="btn btn-primary">{{__('cms.save')}}</button>
                            </div>
                        </div>
                    @else
                            No trainers 
                    @endif
                        <!-- /.card-body -->

                    </div>
                    <!-- /.col -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function performRegister() {
            var trainer_id = $('input[type="radio"]:checked').val();
            axios.post('/trainer/store', {
                trainer_id: trainer_id,
                company_student_id: '{{$student_company_id}}',
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/cms/trainer/login';

                    // reference.closest('tr').remove();
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
