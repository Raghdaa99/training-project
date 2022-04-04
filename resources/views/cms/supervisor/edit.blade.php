@extends('cms.parent')

@section('title',__('cms.update'))

@section('styles')

@endsection

@section('large-page-name',__('cms.update'))
@section('main-page-name',__('cms.admins'))
@section('small-page-name',__('cms.update'))

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
                        <h3 class="card-title">{{__('cms.update')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="role_id">{{__('cms.role')}}</label>
                                <select class="custom-select form-control-border" id="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if($role->id == $adminRole->id) selected
                                        @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"
                                    name="name" value="{{$admin->name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="{{__('cms.enter_email')}}" name="email" value="{{$admin->email}}">
                            </div>
                            <div class="form-group">
                                <label for="gender">{{__('cms.gender')}}</label>
                                <select class="custom-select form-control-border" id="gender">
                                    <option value="Male" @if($admin->gender == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($admin->gender == 'Female') selected @endif>Female
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate()"
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
    function performUpdate() {
        axios.put('/cms/admin/admins/{{$admin->id}}', {
            name: document.getElementById('name').value,
            email_address: document.getElementById('email').value,
            role_id: document.getElementById('role_id').value,
            gender: document.getElementById('gender').value

        })
        .then(function (response) {
            //2xx
            console.log(response);
            toastr.success(response.data.message);
            //
            window.location.href = '/cms/admin/admins';
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection