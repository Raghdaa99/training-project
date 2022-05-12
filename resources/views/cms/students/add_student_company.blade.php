@extends('cms.parent')

@section('title',__('cms.training_data'))

@section('styles')

@endsection

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
                            <h3 class="card-title">{{__('cms.training_data')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="company_id">{{__('cms.company')}}</label>
                                    <select class="custom-select form-control-border" id="company_id"
                                            onchange="showFields()">

                                        @foreach ($companies as $company)
                                            <option
                                                value="{{$company->id}}" {{ $company_id == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="field_id">{{__('cms.fields')}}</label>
                                    @if($fields != null)
                                        @foreach ($fields as $field)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="field_id"
                                                       value="{{$field->id}}" id="field_id">
                                                <label class="form-check-label">{{$field->name}}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p> no fields to this Company</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea id="notes" name="notes"
                                              class="form-control"></textarea>
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
        function showFields() {
            $company_id = document.getElementById('company_id').value;
            // window.location.href = '/cms/student/registerCompany/' + $company_id;

            window.location.replace('/cms/student/registerCompany/{{$student_no}}/?company_id=' + $company_id);


        }

        function performStore() {

            // console.log(document.getElementById('student_no').value);
            var radio1 = $('input[type="radio"]:checked').val();
            axios.post('/cms/student/registerStudentCompany', {
                company_id: document.getElementById('company_id').value,
                field_id: radio1,
                notes: document.getElementById('notes').value,
                student_no: {{$student_no}},
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    // document.getElementById('create-form').reset();
                    @auth('student')
                        window.location.href = '/cms/student/registerStudentCompany';
                    @endauth

                    @auth('supervisor')
                        window.location.href = '/cms/supervisor/show/Students';
                    @endauth

                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
