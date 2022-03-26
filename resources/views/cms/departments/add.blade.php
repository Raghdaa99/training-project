@extends('cms.parent')

@section('styles')

@endsection
@section('large-page-name',__('cms.create'))
@section('main-page-name',__('cms.departments'))
@section('small-page-name',__('cms.create'))
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('cms.create')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">{{__('cms.department_name')}}</label>
                                    <input type="text" class="form-control" id="name" placeholder="{{__('cms.department_name')}}"
                                           name="name">
                                </div>
                                <div class="form-group">
                                    <label for="department_no">{{__('cms.department_no')}}</label>
                                    <input type="text" class="form-control" id="department_no"
                                           placeholder="{{__('cms.department_no')}}" name="department_no">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performStore()"
                                        class="btn btn-primary">{{__('cms.save')}}</button>
                            </div>
                        </form>
                    </div>
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

<script>
    function performStore() {

        axios.post('/cms/admin/departments', {
            department_no: document.getElementById('department_no').value,
            department_name: document.getElementById('name').value,

            })
            .then(function(response) {
                toastr.success(response.data.message);

                console.log(response);
                document.getElementById('create-form').reset();
                window.location.href = '/cms/admin/departments';

            })
            .catch(function(error) {
                toastr.error(error.response.data.message);

                console.log(error.response.data.message);
            });
    }
</script>
@endsection
