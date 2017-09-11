@extends('layouts.auth')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <b>Coffee Crib POS</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <form method="POST" action="/login">
          {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          @include('partials.error')
        </div>
        <div class="row">
            <div class="col-xs-8">
            <!-- <a href="#">I forgot my password</a><br> -->
            </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

@endsection