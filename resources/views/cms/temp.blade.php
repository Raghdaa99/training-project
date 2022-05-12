@extends('admin.parent')
@section('title','Home')


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

                                <form action="" method="POST">
                                    @csrf
                                    <table class="tbl-30">
                                        <tr>
                                            <td>Current Password:</td>
                                            <td>
                                                <input type="password" name="oldpassword" placeholder="Current Password"
                                                       required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>New Password:</td>
                                            <td>
                                                <input type="password" name="newpassword" placeholder="New Password"
                                                       required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Confirm Password:</td>
                                            <td>
                                                <input type="password" name="password_confirmation"
                                                       placeholder="Confirm Password" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <input type="hidden" name="id" value="">
                                                <input type="submit" name="submit" value="Change Password"
                                                       class="btn-secondary">
                                            </td>
                                        </tr>

                                    </table>

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
