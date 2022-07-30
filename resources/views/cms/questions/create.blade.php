@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')

@endsection

@section('large-page-name',__('cms.create'))
@section('main-page-name','questions')
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
                                <label for="guard">{{__('cms.guard')}}</label>
                                <select class="custom-select form-control-border" id="guard">
                                    <option value="supervisor">Supervisor</option>
                                    <option value="trainer">Trainer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title Question</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title Of Question"
                                    name="title">
                            </div>
                            <div class="form-group">
                                <label for="max_mark">Max Mark</label>
                                <input type="number" class="form-control" id="max_mark" placeholder="Enter Max Mark Of Question"
                                       name="max_mark">
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
        axios.post('/cms/admin/questions', {
            title: document.getElementById('title').value,
            guard: document.getElementById('guard').value,
            max_mark: document.getElementById('max_mark').value
        })
        .then(function (response) {
            //2xx
            console.log(response);
            toastr.success(response.data.message);
            // document.getElementById('create-form').reset();
            window.location.href = '/cms/admin/questions';
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection
