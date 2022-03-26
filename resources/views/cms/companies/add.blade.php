@extends('cms.parent')

@section('styles')

@endsection
@section('large-page-name',__('cms.create'))
@section('main-page-name',__('cms.company'))
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
                                    <label for="name">{{__('cms.company_name')}}</label>
                                    <input type="text" class="form-control" id="name" placeholder="{{__('cms.company_name')}}"
                                           name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{__('cms.company_email')}}</label>
                                    <input type="email" class="form-control" id="email"
                                           placeholder="{{__('cms.company_email')}}" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{__('cms.company_phone')}}</label>
                                    <input type="text" class="form-control" id="phone"
                                           placeholder="{{__('cms.company_phone')}}" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="address">{{__('cms.company_address')}}</label>
                                    <input type="text" class="form-control" id="address"
                                           placeholder="{{__('cms.company_address')}}" name="address">
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

        axios.post('/cms/admin/companies', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address: document.getElementById('address').value,

            })
            .then(function(response) {
                toastr.success(response.data.message);

                console.log(response);
                document.getElementById('create-form').reset();
                window.location.href = '/cms/admin/companies';

            })
            .catch(function(error) {
                toastr.error(error.response.data.message);

                console.log(error.response.data.message);
            });
    }
</script>
@endsection
