@extends('master')
@section('page-title', 'Users')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update User: <strong>{{ $user->name }}</strong></h3>
          </div>
          @if(session('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{ route('users.update', ['id' => $user->id]) }}">
            @csrf
            <div class="card-body">
              @include('users.fragments.form-update')
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
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