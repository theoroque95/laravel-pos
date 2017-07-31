@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h1><i class="fa fa-user"> Add New User</i></h1>
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
			    <form role="form" method="POST" action="/staff/add">
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="username">Username</label>
			          <input type="text" class="form-control" id="username" placeholder="Enter Username" value="{{ old('username') }}" name="username">
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
			          <input type="text" class="form-control" id="address" placeholder="Enter Address" value="{{ old('address') }}">
			        </div>
			        <div class="checkbox">
			          <label>
			            <input type="checkbox" name="is_admin" {{ old('is_admin') ? 'checked' : '' }}> Is Admin
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
		</div>
	</section>
</div>
@endsection