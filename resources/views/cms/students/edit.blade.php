@extends('cms.parent')

@section('title',__('cms.update'))

@section('styles')

@endsection

@section('large-page-name',__('cms.update'))
@section('main-page-name',__('cms.students'))
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
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" disabled
                                    name="name" value="{{$student->name}}">

                            </div>
                            <div class="form-group">
                                <label for="id">Academic Number</label>
                                <input type="number" class="form-control" id="id" disabled
                                     name="id" value="{{$student->student_no}}">
                            </div>


                            <div class="form-group">
                                <label for="id_number">ID Number</label>
                                <input type="number" class="form-control" id="id_number" placeholder="Enter ID Number"
                                       name="id_number" value="{{$student->id_number}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" class="form-control" id="phone" placeholder="Enter Phone Number"
                                       name="phone" value="{{$student->phone}}">
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
        axios.put('/cms/student/students/{{$student->student_no}}', {
            id_number: document.getElementById('id_number').value,
            phone :document.getElementById('phone').value,

        })
        .then(function (response) {
            //2xx
            console.log(response);
            toastr.success(response.data.message);
            //
            window.location.href = '/cms/student/show/Student/personal-data';
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection
