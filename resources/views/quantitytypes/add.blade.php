@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h4><a href="/quantitytypes"><i class="fa fa-caret-left"></i> Back</a></h4>
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
			      <h3 class="box-title"><i class="fa fa-plus"></i> Add New Quantity Type</h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/quantitytypes/add">
			    {{ csrf_field() }}
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="name">Name</label>
			          <input type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ old('name') }}" name="name">
			        </div>
			        <div class="form-group">
			          <label for="description">Description</label>
			          <input type="text" class="form-control" id="description" placeholder="Enter Description" value="{{ old('description') }}" name="description">
			        </div>
			        <div class="form-group">
			          <label for="acronym">Acronym</label>
			          <input type="text" class="form-control" id="acronym" placeholder="Enter Percentage" value="{{ old('acronym') }}" name="acronym">
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