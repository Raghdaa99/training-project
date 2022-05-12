@extends('cms.parent')

@section('title',__('cms.update'))

@section('styles')

@endsection

@section('large-page-name',__('cms.update'))
@section('main-page-name',__('cms.fields'))
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
                        <form id="create-form">
                            @csrf
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="name">{{__('cms.company_name')}}</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="{{__('cms.company_name')}}"
                                           name="name" value="{{$company->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{__('cms.company_email')}}</label>
                                    <input type="email" class="form-control" id="email"
                                           placeholder="{{__('cms.company_email')}}" name="email"
                                           value="{{$company->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{__('cms.company_phone')}}</label>
                                    <input type="text" class="form-control" id="phone"
                                           placeholder="{{__('cms.company_phone')}}" name="phone"
                                           value="{{$company->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="address">{{__('cms.company_address')}}</label>
                                    <input type="text" class="form-control" id="address"
                                           placeholder="{{__('cms.company_address')}}" name="address"
                                           value="{{$company->address}}">
                                </div>

                                <div class="form-group">
                                    <label> Training Fields Company :</label>
                                    <div class="icheck-success d-block">
                                        {{--                                        @php($fields_req = [])--}}

                                        @foreach($fields as $field)
                                            <?php $checked = false;?>
                                            @foreach($fields_companies as $field_company)
                                                @if($field->id ==$field_company->id )
                                                    <?php $checked= true;?>
                                                    @endif
                                            @endforeach
                                                <input type="checkbox" value="{{$field->id}}" class="ids" name="ids[]"{{$checked ? 'checked':''}}>
                                                <label for="ids[]">
                                                    {{$field->name}}
                                                </label>
{{--                                            --}}
                                            {{--                                            <label for="field_{{$field->id}}">{{$field->name}}</label>--}}
                                            <br>
                                        @endforeach
                                    </div>
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
            var ids = [];
            $('.ids:checked').each(function(i, e) {
                ids.push($(this).val());
            });
            axios.put('/cms/admin/companies/{{$company->id}}', {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                fields_req: ids,
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/cms/admin/companies';
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
