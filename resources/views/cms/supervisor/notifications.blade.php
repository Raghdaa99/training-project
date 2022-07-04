@extends('cms.parent')

@section('title',__('cms.admins'))

@section('styles')

@endsection

@section('large-page-name','Notifications')
{{--@section('main-page-name',__('cms.admins'))--}}
{{--@section('small-page-name','Notifications')--}}

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(count(auth()->user()->unreadnotifications)>0)
                            @foreach(auth()->user()->unreadnotifications as $notification)
                                <div class="bg-cyan p-3 m-2 text-black">
                                    @if($notification->data['status_company']==1)
                                        The student <b>{{$notification->data['student_name']}} </b>, whose academic number is <b> {{$notification->data['student_no']}}</b>,
                                        has been accepted by {{$notification->data['company_name']}} Company in {{$notification->data['field_name']}} Field
                                    @else
                                        The student <b>{{$notification->data['student_name']}} </b>, whose academic number is <b> {{$notification->data['student_no']}}</b>,
                                        has not been accepted by {{$notification->data['company_name']}} Company in {{$notification->data['field_name']}} Field
                                    @endif
                                    <a href="{{route('markAsRead',$notification->id)}}" class="p-2 bg-red text-white rounded-lg">Mark As Read</a>
                                </div>
                                <hr>
                            @endforeach
                            @else
                                <div class="alert alert-warning alert-dismissible" style="margin: 15px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                    No Notifications Found
                                </div>
                            @endif
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
@endsection
