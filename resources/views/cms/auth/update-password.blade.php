@extends('cms.parent')

@section('title','Update Password')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="large-12 columns">
                <div class="custom-panel">
                    <div class="custom-panel-heading">
                        <h4>Change Password</h4>
                    </div>

                    <div class="custom-panel-body">

                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="current-password">Current Password:</label>
                                    <input type="password" class="form-control" id="current_password" placeholder="Current Password">
                                </div>
                                <div class="form-group">
                                    <label for="new-password">New Password:</label>
                                    <input type="password" class="form-control" placeholder="Password" id="new_password">

                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password:</label>
                                    <input type="password" class="form-control" placeholder="Retype password" id="password_confirmation">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performChangePassword()" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script>
    function performChangePassword() {

        axios.post('/cms/update-password', {
                oldpassword: document.getElementById('current_password').value,
                newpassword: document.getElementById('new_password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            })
            .then(function(response) {
                //2xx
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById('create-form').reset();
            })
            .catch(function(error) {
                //4xx - 5xx
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
    }
</script>
@endsection