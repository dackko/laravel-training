@extends('admin.master')
@section('page-title', 'Users')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New User</h3>
          </div>
          @if(session('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="card-body">
              @include('admin.users.fragments.form')
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
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