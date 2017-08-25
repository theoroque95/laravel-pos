@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/staff/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Staff</button></a>
  </section>
  <section class="content">
    @include('partials.notification')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Staff &amp; Users</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
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
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" data-id="{{ $user->id }}" data-form="staff"><i class="fa fa-trash"></i></button>
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

@include('partials.modalDelete')
@endsection