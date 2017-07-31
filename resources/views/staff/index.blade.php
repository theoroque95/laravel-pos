@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/staff/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Staff</button></a>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Staff &amp; Users</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Birthdate</th>
                <th>Address</th>
                <th>Is Admin?</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->birthdate }}</td>
                  <td>{{ $user->address }}</td>
                  <td><input type="checkbox" name="is_admin" disabled="true" {{ $user->is_admin ? 'checked' : '' }}></td>
                  <td>
                    <div class="btn-group">
                      <a href="/staff/{{ $user->id }}"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal"><i class="fa fa-trash"></i></button>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete User</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection