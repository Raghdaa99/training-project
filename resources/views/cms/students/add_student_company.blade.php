@extends('cms.parent')

@section('title',__('cms.training_data'))

@section('styles')

@endsection




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
                        <h3 class="card-title">{{__('cms.training_data')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="company_id">{{__('cms.company')}}</label>
                                <select class="custom-select form-control-border" id="company_id">
                                    @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="field_id">{{__('cms.fields')}}</label>
                                <select class="custom-select form-control-border" id="field_id">
                                    @foreach ($fields as $field)
                                        <option value="{{$field->id}}">{{$field->name}}</option>
                                    @endforeach
                                </select>
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
        axios.post('/cms/admin/admins', {
            name: document.getElementById('name').value,
            email_address: document.getElementById('email').value,
            role_id: document.getElementById('role_id').value,
            gender: document.getElementById('gender').value
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
