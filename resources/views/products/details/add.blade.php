@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h4><a href="/details"><i class="fa fa-caret-left"></i> Back</a></h4>
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
			      <h3 class="box-title"><i class="fa fa-circle-o"> Add New Product</i></h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/details/add">
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
		           		<label>Category</label>
		                <select class="form-control select2" style="width: 100%;">
		                  <option name="category" selected="selected">- Select Category -</option>
		                  @foreach ($categories as $category)
			                  <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
		                  @endforeach
		                </select>
		            </div>
		            <div class="form-group">
			          <label for="expected_quantity">Expected Quantity</label>
			          <input type="number" class="form-control" id="expected_quantity" placeholder="Enter Expected Quantity" value="{{ old('expected_quantity') }}" name="expected_quantity">
			        </div>
			        <div class="form-group">
			          <label for="actual_quantity">Actual Quantity</label>
			          <input type="number" class="form-control" id="actual_quantity" placeholder="Enter Actual Quantity" value="{{ old('actual_quantity') }}" name="actual_quantity">
			        </div>
			        <div class="form-group">
		           		<label>Measurement Unit</label>
		                <select class="form-control select2" style="width: 100%;">
		                  <option selected="selected">- Select Measurement Unit -</option>
		                  @foreach ($quantityTypes as $quantityType)
			                  <option name="quantity_type" value="{{ $quantityType->id }}">{{ ucfirst($quantityType->name) }} ({{ $quantityType->acronym }})</option>
		                  @endforeach
		                </select>
		            </div>
		            <div class="form-group">
			          <label for="product_code">Product Code</label>
			          <input type="text" class="form-control" id="product_code" placeholder="Enter Product Code" value="{{ old('product_code') }}" name="product_code">
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