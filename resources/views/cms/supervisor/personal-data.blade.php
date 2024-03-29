@extends('cms.parent')

@section('title','Personal Data')

@section('styles')

@endsection

@section('large-page-name','Personal Data')
@section('main-page-name','Personal Data')
{{--@section('small-page-name',__('cms.index'))--}}

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
                                    <thead>
                                    <tr>
                                        <th>Supervisor No</th>
                                        <td>{{$supervisor->supervisor_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>Supervisor Name</th>
                                        <td>{{$supervisor->name}}</td>
                                    </tr>

                                    <tr>
                                        <th>ID Number</th>
                                        <td>{{$supervisor->id_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td>{{$supervisor->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$supervisor->email}}</td>
                                    </tr>
                                    </thead>


{{--                                    <tbody>--}}

{{--                                    </tbody>--}}
                                </table>
                            <a href="{{route('supervisors.edit',$supervisor->supervisor_no)}}" class="btn btn-success"
                               style="width: 200px; ">
                                <i class="fas fa-user-edit"> Edit </i>
                            </a>

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

