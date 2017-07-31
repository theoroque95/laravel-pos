@extends('layouts.auth')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <b>Login</b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in</p>

      <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
            <a href="#">I forgot my password</a><br>
              <a href="/register" class="text-center">Register a new membership</a>
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