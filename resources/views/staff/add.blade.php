@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h4><a href="/staff"><i class="fa fa-caret-left"></i> Back</a></h4>
    </section>

	<!-- Main content -->
	<section class="content">
		@include('partials.notification')
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-primary">
			    <div class="box-header with-border">
			      <h3 class="box-title"><i class="fa fa-user"> Add New User</i></h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/staff/add">
			    {{ csrf_field() }}
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="username">Username</label>
			          <input type="text" class="form-control" id="username" placeholder="Enter Username" value="{{ old('username') }}" name="username">
			        </div>
			        <div class="form-group">
			          <label for="password">Password</label>
			          <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
			        </div>
			        <div class="form-group">
			          <label for="password_confirmation">Confirm Password</label>
			          <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
			        </div>
			        <div class="form-group">
			          <label for="first_name">First Name</label>
			          <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" name="first_name">
			        </div>
			        <div class="form-group">
			          <label for="last_name">Last Name</label>
			          <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" name="last_name">
			        </div>
			        <div class="form-group">
			          <label for="email">Email address</label>
			          <input type="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}" name="email">
			        </div>
			        <div class="form-group">
		                <label>Phone</label>
						<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number" data-inputmask='"mask": "(999) 999-9999"' data-mask>
					</div>
					<div class="form-group">
						<label>Birthdate</label>
						<div class="input-group date">
						  <div class="input-group-addon">
						    <i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right" name="birthdate" id="datepicker" value="{{ old('birthdate') }}">
						</div>
					</div>
					<div class="form-group">
			          <label for="address">Address</label>
			          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ old('address') }}">
			        </div>
			        <div class="checkbox">
			          <label>
			            <input type="checkbox" name="is_admin"> Is Admin
			          </label>
			        </div>
			      </div>
			      <!-- /.box-body -->

			      <div class="box-footer">
			        <button type="submit" class="btn btn-primary pull-right">Submit</button>
			      </div>
			    </form>
			  </div>
			  <!-- /.box -->
			</div>
			<div class="col-md-6">
				@include('partials.error')
			</div>
		</div>
	</section>
</div>
@endsection