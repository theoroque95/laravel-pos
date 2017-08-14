@extends('layouts.main')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h4><a href="/ingredients"><i class="fa fa-caret-left"></i> Back</a></h4>
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
			      <h3 class="box-title">Edit Ingredient Information</h3>
			    </div>
			    <!-- /.box-header -->
			    <!-- form start -->
			    <form role="form" method="POST" action="/ingredients/{{$ingredient->id}}">
			    	{{ csrf_field() }}
			      <div class="box-body">
			      	<div class="form-group">
			          <label for="name">Name</label>
			          <input type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $ingredient->name }}" name="name">
			        </div>
			        <div class="form-group">
			          <label for="description">Description</label>
			          <input type="text" class="form-control" id="description" placeholder="Enter Description" value="{{ $ingredient->description }}" name="description">
			        </div>
					<div class="form-group">
			          <label for="expected_quantity">Expected Quantity</label>
			          <input type="number" class="form-control" id="expected_quantity" placeholder="Enter Description" value="{{ $ingredient->expected_quantity }}" name="expected_quantity">
			        </div>
			        <div class="form-group">
			          <label for="actual_quantity">Actual Quantity</label>
			          <input type="number" class="form-control" id="actual_quantity" placeholder="Enter Description" value="{{ $ingredient->actual_quantity }}" name="actual_quantity">
			        </div>
			        <div class="form-group">
				   		<label>Measurement Unit</label>
				        <select class="form-control select2" style="width: 100%;" name="quantity_type">
				          <option selected="selected">- Select Measurement Unit -</option>
				          @foreach ($quantityTypes as $quantityType)
				              <option value="{{ $quantityType->id }}" id="{{ $quantityType->id }}">{{ ucfirst($quantityType->name) }} ({{ $quantityType->acronym }})</option>
				          @endforeach
				        </select>
				    </div>
			      </div>
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

@section('scripts')
	<script>
		$("#{{ $ingredient->quantity_type_id }}").attr('selected', 'selected');
	</script>
@endsection