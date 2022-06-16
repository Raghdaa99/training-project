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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                @if(count($companies)>0)

                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.company_name')}}</th>
                                    <th>{{__('cms.company_email')}}</th>
                                    <th>{{__('cms.company_phone')}}</th>
                                    <th>{{__('cms.company_address')}}</th>
                                    <th>{{__('cms.fields')}}</th>
                                    <th style="width: 40px">Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->phone}}</td>
                                        <td>{{$company->address}}</td>
                                        <td><a class="btn btn-primary btn-sm"
                                               href="{{route('companies.show',$company->id)}}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('companies.edit',$company->id)}}"
                                                   class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete('{{$company->id}}',this)"
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
                                        No Companies Added
                                    </div>
                                @endif
                            </table>
                            {{-- Pagination --}}
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                {!! $companies->links() !!}--}}
{{--                            </div>--}}
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
            axios.delete('/cms/admin/companies/' + id)
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    reference.closest('tr').remove();
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
