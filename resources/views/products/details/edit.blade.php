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
			<form role="form" method="POST" action="/details/{{$product->id}}">
			    {{ csrf_field() }}
				<div class="box box-primary">
					<div class="col-md-6">
						<div class="box-header with-border">
						  <h3 class="box-title"><i class="fa fa-circle-o"> Edit Product Information</i></h3>
						</div>
						<div class="box-body">
						  	<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $product->name }}" name="name">
						    </div>
						    <div class="form-group">
								<label for="description">Description</label>
								<input type="text" class="form-control" id="description" placeholder="Enter Description" value="{{ $product->description }}" name="description">
						    </div>
						    <div class="form-group">
						   		<label>Category</label>
						        <select class="form-control select2" style="width: 100%;" name="category">
						          <option selected="selected">- Select Category -</option>
						          @foreach ($categories as $category)
						              <option value="{{ $category->id }}" id="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
						          @endforeach
						        </select>
						    </div>
						    <div class="form-group">
								<label for="expected_quantity">Expected Quantity</label>
								<input type="number" class="form-control" id="expected_quantity" placeholder="Enter Expected Quantity" value="{{ $product->expected_quantity }}" name="expected_quantity">
						    </div>
						    <div class="form-group">
								<label for="actual_quantity">Actual Quantity</label>
								<input type="number" class="form-control" id="actual_quantity" placeholder="Enter Actual Quantity" value="{{ $product->actual_quantity }}" name="actual_quantity">
						    </div>
						    <div class="form-group">
						   		<label>Measurement Unit</label>
						        <select class="form-control select2" style="width: 100%;" name="quantity_type">
						          <option selected="selected">- Select Measurement Unit -</option>
						          @foreach ($quantityTypes as $quantityType)
						              <option value="{{ $quantityType->id }}" id="{{ $quantityType->name }}">{{ ucfirst($quantityType->name) }} ({{ $quantityType->acronym }})</option>
						          @endforeach
						        </select>
						    </div>
						    <div class="form-group">
								<label for="product_code">Product Code</label>
								<input type="text" class="form-control" id="product_code" placeholder="Enter Product Code" value="{{ $product->product_code }}" name="product_code">
						    </div>
						</div>
					</div>
					<div class="col-md-6">
					    <div class="box-header with-border">
							<h4 class="box-title"><i class="fa fa-circle-o"> Menu Subcategories</i></h4>
					    </div>
					    <div class="form-group">
					    	<button class="btn btn-success btn-sm" type="button" onclick="addMenuSubcategory()"><i class="fa fa-plus"></i> Add Another Menu Subcategory
					    	</button>
					    </div>
					    <div class="form-group menu-subcategory">
					    	<div class="row">
						    	<div class="col-xs-3">Subcategory</div>
						    	<div class="col-xs-3">Price (&#8369;)</div>
						    	<div class="col-xs-3">Size ({{ ucfirst($quantityType->name) }}) </div>
						    </div>
					    </div>
					    <div class="form-group">
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
						</div>
						<div class="form-group">
							@include('partials.error')
						</div>
					</div>
				</div>
		    </form>
		</div>
	</section>
</div>
@endsection

@section('scripts')
	<script>
		$("#{{ $product->quantity_type_name }}").attr('selected', 'selected');
		$("#{{ $product->category_name }}").attr('selected', 'selected');

		var newId = 0;
		function addMenuSubcategory() {
			newId = newId + 1;
			$(".menu-subcategory").append('<div class="row submenu" id="submenu-'+newId+'"><br><div class="col-xs-3"><input type="text" class="form-control" placeholder="Subcategory Name" id="subname-'+newId+'" name="subnames['+newId+']" required="true"></div><div class="col-xs-3"><input type="number" class="form-control" placeholder="Price" id="subprice-'+newId+'" name="subprices['+newId+']" required="true"></div><div class="col-xs-3"><input type="number" class="form-control" placeholder="Quantity" id="subquantity-'+newId+'" name="subquantities['+newId+']" required="true"></div><div class="col-xs-2"><button class="btn btn-danger btn-sm" type="button" onclick="removeMenuSubcategory('+newId+')"><i class="fa fa-minus"></i></div>');
		}

		var deleteKey = 0;
		function removeMenuSubcategory(id) {
			if ($('.menu-subcategory > div.submenu').length > 1) {
				var deleteId = $("#submenuId-"+id).val();

				if (typeof deleteId != 'undefined') {
					console.log('deleteId'+deleteId);
					$(".menu-subcategory").append('<input type="hidden" id="delete-'+deleteKey+'" name="deletes['+deleteKey+']" value="'+deleteId+'">');
					deleteKey++;
				}
				$("#submenu-"+id).remove();
			}
			else {
				alert('Cannot delete last menu category.');
			}
		}
	</script>
	@foreach($productSubmenus as $productSubmenu)
		<script>
		$(".menu-subcategory").append('<div class="row submenu" id="submenu-'+newId+'"><br><div class="col-xs-3"><input type="hidden" id="submenuId-'+newId+'" name="submenuId['+newId+']" value="{{ $productSubmenu->id }}"><input type="text" class="form-control" placeholder="Subcategory Name" id="subname-'+newId+'" name="subnames['+newId+']" required="true" value="{{ $productSubmenu->name }}"></div><div class="col-xs-3"><input type="number" class="form-control" placeholder="Price" id="subprice-'+newId+'" name="subprices['+newId+']" required="true" value="{{ $productSubmenu->price }}"></div><div class="col-xs-3"><input type="number" class="form-control" placeholder="Quantity" id="subquantity-'+newId+'" name="subquantities['+newId+']" required="true" value="{{ $productSubmenu->quantity }}"></div><div class="col-xs-2"><button class="btn btn-danger btn-sm" type="button" onclick="removeMenuSubcategory('+newId+')"><i class="fa fa-minus"></i></div>');
			newId = newId + 1;
		</script>
	@endforeach
@endsection