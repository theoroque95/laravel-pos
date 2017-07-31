@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h1><i class="fa fa-user"> Staff ID: {{ $user->id }}</i></h1>
		<br>
		<a href="/staff"> < Back</a>
    </section>

	<!-- Main content -->
	<section class="content">
		@include('partials.notification')
		@include('partials.error')
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-primary">
			    <div class="box-header with-border">
			      <h3 class="box-title">Edit Information</h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/staff/{{$user->id}}">
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="username">Username</label>
			          <input type="text" class="form-control" id="username" placeholder="Enter Username" value="{{ $user->username }}" name="username">
			        </div>
			        <div class="form-group">
			          <label for="first_name">First Name</label>
			          <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" value="{{ $user->first_name }}" name="first_name">
			        </div>
			        <div class="form-group">
			          <label for="last_name">Last Name</label>
			          <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{ $user->last_name }}" name="last_name">
			        </div>
			        <div class="form-group">
			          <label for="email">Email address</label>
			          <input type="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email }}" name="email">
			        </div>
			        <div class="form-group">
		                <label>Phone</label>
						<input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Enter phone number" data-inputmask='"mask": "(999) 999-9999"' data-mask>
					</div>
					<div class="form-group">
						<label>Birthdate</label>
						<div class="input-group date">
						  <div class="input-group-addon">
						    <i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right" name="birthdate" id="datepicker" value="{{ $user->birthdate }}">
						</div>
					</div>
					<div class="form-group">
			          <label for="address">Address</label>
			          <input type="text" class="form-control" id="address" placeholder="Enter Address" value="{{ $user->address }}">
			        </div>
			        <div class="checkbox">
			          <label>
			            <input type="checkbox" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}> Is Admin
			          </label>
			        </div>
			      </div>
			      <!-- /.box-body -->

			      <div class="box-footer">
			        <button type="submit" class="btn btn-primary">Submit</button>
			      </div>
			    </form>
			  </div>
			  <!-- /.box -->
			</div>
			<!-- right column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-primary">
			    <div class="box-header with-border">
			      <h3 class="box-title">Change Password</h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/staff/{{$user->id}}/changepassword">
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="old_password">Current Password</label>
			          <input type="password" class="form-control" id="old_password" placeholder="Enter old password" name="old_password">
			        </div>
			        <div class="form-group">
			          <label for="password">New Password</label>
			          <input type="password" class="form-control" id="password" placeholder="Enter new password" name="password">
			        </div>
			        <div class="form-group">
			          <label for="confirm_password">Confirm New Password</label>
			          <input type="password" class="form-control" id="confirm_password" placeholder="Confirm your new password" name="confirm_password">
			        </div>
			      </div>
			      <!-- /.box-body -->
			      <div class="box-footer">
			        <button type="submit" class="btn btn-primary">Submit</button>
			      </div>
			    </form>
			  </div>
			  <!-- /.box -->
			</div>
		</div>
	</section>
</div>
@endsection