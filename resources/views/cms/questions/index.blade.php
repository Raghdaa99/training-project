@extends('cms.parent')

@section('title','Questions')

@section('styles')

@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name','questions')
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
                            <p><strong>Total marks of Trainer : <span class=" mr-5 bg-gradient-dark p-2">
                                    {{$totalMarksOfTrainer}}</span></strong>
                                <span
                                    class="mr-5"><strong>Total marks of Supervisor : <span class="bg-gradient-dark p-2">
                                            {{$totalMarksOfSupervisor}}
                                        </span></strong></span>
                                <span
                                    class="mr-auto"><strong>Total : <span class="bg-gradient-dark p-2">
                                        {{$totalMarksOfSupervisor+$totalMarksOfTrainer}}
                                   </span> </strong></span>
                            </p>
                            @if($totalMarksOfTrainer+$totalMarksOfSupervisor > 100 )
                                <div class="alert alert-danger alert-dismissible" style="margin: 15px">
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    مجموع علامات المدرب والمشرف اكبر من 100
                                </div>
                            @endif
                            <table class="table table-bordered table-striped table-hover">
                                @if(count($questions)>0)

                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{__('cms.name')}}</th>
                                        <th>{{__('cms.guard')}}</th>
                                        <th>Max OF Mark</th>
                                        <th style="width: 40px">Settings</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$question->title}}</td>
                                            <td>{{$question->guard}}</td>
                                            <td>{{$question->max_mark}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('questions.edit',$question->id)}}"
                                                       class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" onclick="confirmDelete('{{$question->id}}',this)"
                                                       class=" btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                @else
                                    <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                        No Questions Added
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

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    performDelete(id, reference);
                }
            });
        }

        function performDelete(id, reference) {
            axios.delete('/cms/admin/questions/' + id)
                .then(function (response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    reference.closest('tr').remove();
                })
                .catch(function (error) {
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
