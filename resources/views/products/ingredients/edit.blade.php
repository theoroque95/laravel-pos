@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h4><a href="/categories"><i class="fa fa-caret-left"></i> Back</a></h4>
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
			      <h3 class="box-title">Edit Category Information</h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/categories/{{$category->id}}">
			    	{{ csrf_field() }}
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="name">Name</label>
			          <input type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $category->name }}" name="name">
			        </div>
			        <div class="form-group">
			          <label for="description">Description</label>
			          <input type="text" class="form-control" id="description" placeholder="Enter Description" value="{{ $category->description }}" name="description">
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
		</div>
	</section>
</div>
@endsection