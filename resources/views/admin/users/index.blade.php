@extends('admin.master')
@section('page-title', 'Users')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create
                New
                User</a>
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if(session('message'))
              <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <table id="dataTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
              </thead>

              <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->UserType->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at->format('H:i, d M Y') }}</td>
                  <td>
                    <a href="{{ route('admin.users.show', ['user' => $user->id]) }}"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"><i class="fa fa-pen"></i></a>
                    <a class="delete-item" data-url="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                       data-token="{{ csrf_token() }}"
                       style="cursor:pointer;"><i
                          class="fa fa-trash" style="color:red;"></i></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@endsection
@section('js')
  <script>
    $(function () {
      $("#dataTable").DataTable();
    });
  </script>
@endsection