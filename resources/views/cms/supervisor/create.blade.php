@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')

@endsection

@section('large-page-name',__('cms.create'))
@section('main-page-name',__('cms.supervisors'))
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
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="number">{{__('cms.number')}}</label>
                                <input type="text" class="form-control" id="number"
                                    placeholder="{{__('cms.number')}}" name="number">
                            </div>
                            <div class="form-group">
                                <label for="password">{{__('cms.password')}}</label>
                                <input type="password" class="form-control" id="password"
                                       placeholder="{{__('cms.password')}}" name="password">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email"
                                       placeholder="{{__('cms.email')}}" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{__('cms.phone')}}</label>
                                <input type="text" class="form-control" id="phone"
                                       placeholder="{{__('cms.phone')}}" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="">Department</label>
                                <select class="custom-select form-control-border" id="department_no">
                                    @foreach ($departments as $department)
                                        <option value="{{$department->department_no}}">{{$department->name}}</option>
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
        axios.post('/cms/admin/supervisors', {
            name: document.getElementById('name').value,
            number: document.getElementById('number').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            phone: document.getElementById('phone').value,
            department_no: document.getElementById('department_no').value,
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
