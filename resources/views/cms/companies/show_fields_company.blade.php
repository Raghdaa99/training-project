@extends('cms.parent')

@section('styles')

@endsection
@section('large-page-name',__('cms.show'))
@section('main-page-name',__('cms.company'))
@section('small-page-name',__('cms.show'))
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
                            <h3 class="card-title">{{__('cms.show')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">{{__('cms.company_name')}}</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="{{__('cms.company_name')}}"
                                           name="name" value="{{$company->name}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label> Training Fields Company :</label>
                                    <div class="icheck-success d-block">
                                        @if(count($fields)>0)
                                        @foreach($fields as $field)
{{--                                            <input type="checkbox" value="{{$field->id}}" class="ids" name="ids[]">--}}
                                            <label for="ids[]">
                                                {{$field->name}}
                                            </label>
                                            <br>
                                        @endforeach
                                        @else
                                            <label id="state">
                                                No Fields To this Company
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

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
<script>

    // $('#state').html()
</script>
