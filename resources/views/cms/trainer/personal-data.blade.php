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
                                        <th>Trainer Email</th>
                                        <td>{{$trainer->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Trainer Name</th>
                                        <td>{{$trainer->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Company Name</th>
                                        <td>{{$trainer->company->name}}</td>

                                    </tr>

                                    <tr>
                                        <th>Phone Number</th>
                                        <td>{{$trainer->phone}}</td>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    {{--                                    @foreach ($items as $item)--}}
                                    <tr>
                                        {{--                                            <td>{{$loop->iteration}}</td>--}}



                                        {{--                                        @if($item->status_supervisor==0)--}}
                                        {{--                                           --}}
                                        {{--                                        @endif--}}
{{--                                        @if($item->status_company==1)--}}

{{--                                           --}}
{{--                                        @endif--}}
                                    </tr>
                                    {{--                                    @endforeach--}}


                                    </tbody>
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

