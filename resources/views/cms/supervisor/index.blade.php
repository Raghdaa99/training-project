@extends('cms.parent')

@section('title',__('cms.admins'))

@section('styles')

@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name',__('cms.admins'))
@section('small-page-name',__('cms.index'))

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Bordered Table</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>{{__('cms.name')}}</th>
                  <th>{{__('cms.number')}}</th>
                  <th>{{__('cms.email')}}</th>
                  <th>{{__('cms.phone')}}</th>
                  <th style="width: 40px">Settings</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($supervisors as $supervisor)
                <tr>
                    <td>{{$loop->iteration}}</td>
                  <td>{{$supervisor->name}}</td>
                  <td>{{$supervisor->supervisor_no}}</td>
                  <td>{{$supervisor->email}}</td>
                  <td>{{$supervisor->phone}}</td>

                  <td>
                    <div class="btn-group">
                      <a href="{{route('admins.edit',$supervisor->supervisor_no)}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" onclick="confirmDelete('{{$supervisor->supervisor_no}}',this)" class=" btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </a>
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
  function confirmDelete(id,reference) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        performDelete(id,reference);
      }
    });
  }

  function performDelete(id,reference) {
    axios.delete('/cms/admin/supervisors/'+id)
    .then(function (response) {
        //2xx
        console.log(response);
        toastr.success(response.data.message);
        reference.closest('tr').remove();
    })
    .catch(function (error) {
        //4xx - 5xx
        console.log(error.response.data.message);
        toastr.error(error.response.data.message);
    });
  }
</script>
@endsection
