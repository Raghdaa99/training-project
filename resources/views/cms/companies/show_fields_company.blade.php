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

{{--                                <div class="form-group">--}}
{{--                                    <label> Training Fields Company :</label>--}}
{{--                                    <div class="icheck-success d-block">--}}
{{--                                        @if(count($fields)>0)--}}
{{--                                        @foreach($fields as $field)--}}
{{--                                            <input type="checkbox" value="{{$field->id}}" class="ids" name="ids[]">--}}
{{--                                            <label for="ids[]">--}}
{{--                                                {{$field->name}}--}}
{{--                                            </label>--}}
{{--                                            <br>--}}
{{--                                        @endforeach--}}
{{--                                        @else--}}
{{--                                            <label id="state">--}}
{{--                                                No Fields To this Company--}}
{{--                                            </label>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

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
                                            <input type="checkbox" value="{{$field->id}}" class="ids" onclick="updateCompanyField('{{$company->id}}','{{$field->id}}')"name="ids[]"{{$checked ? 'checked':''}}>
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
{{--                            <div class="card-footer">--}}
{{--                                <button type="button" onclick="performUpdate()"--}}
{{--                                        class="btn btn-primary">{{__('cms.save')}}</button>--}}
{{--                            </div>--}}
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
        function updateCompanyField(companyId, fieldId) {
            axios.post('/cms/admin/update-companies-fields',{
                'company_id':companyId,
                'field_id':fieldId
            })
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }



        {{--function performUpdate() {--}}
        {{--    var ids = [];--}}
        {{--    $('.ids:checked').each(function(i, e) {--}}
        {{--        ids.push($(this).val());--}}
        {{--    });--}}
        {{--    axios.put('/cms/admin/companies-fields/{{$company->id}}/update', {--}}
        {{--        fields_req: ids,--}}
        {{--    })--}}
        {{--        .then(function (response) {--}}
        {{--            //2xx--}}
        {{--            console.log(response);--}}
        {{--            toastr.success(response.data.message);--}}
        {{--            // window.location.href = '/cms/admin/companies';--}}
        {{--        })--}}
        {{--        .catch(function (error) {--}}
        {{--            //4xx - 5xx--}}
        {{--            console.log(error.response.data.message);--}}
        {{--            toastr.error(error.response.data.message);--}}
        {{--        });--}}
        {{--}--}}
    </script>
@endsection
