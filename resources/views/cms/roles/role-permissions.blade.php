@extends('cms.parent')

@section('title',__('cms.permissions'))

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name',__('cms.assigned_permissions'))
@section('small-page-name',__('cms.index'))

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{$role->name}} {{__('cms.permissions')}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>{{__('cms.name')}}</th>
                  <th>{{__('cms.guard')}}</th>
                  <th>{{__('cms.assigned')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($permissions as $permission)
                <tr>
                  <td>{{$permission->name}}</td>
                  <td>{{$permission->guard_name}}</td>
                  <td>
                    <div class="icheck-success d-inline">
                      <input type="checkbox" id="permission_{{$permission->id}}" @if($permission->assigned)
                      checked @endif
                      onclick="updateRolePermission('{{$role->id}}','{{$permission->id}}')">
                      <label for="permission_{{$permission->id}}"></label>
                    </div>
                  </td>
                </tr>
                @endforeach

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

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function updateRolePermission(roleId, permissionId) {
    axios.post('/cms/admin/role/update-permission',{
      'role_id':roleId,
      'permission_id':permissionId
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
</script>
@endsection