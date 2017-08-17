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
		@include('partials.error')
		<div class="row">
			<!-- left column -->
			<form role="form" method="POST" action="/details/add">
			    {{ csrf_field() }}
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title"><i class="fa fa-plus"></i> Add New Product</h3>
						</div>
						<div class="box-body">
						  	<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ old('name') }}" name="name" required="true">
						    </div>
						    <div class="form-group">
								<label for="description">Description</label>
								<input type="text" class="form-control" id="description" placeholder="Enter Description" value="{{ old('description') }}" name="description" required="true">
						    </div>
						    <div class="form-group">
						   		<label>Category</label>
						        <select class="form-control select2" style="width: 100%;" name="category">
						          <option selected="selected">- Select Category -</option>
						          @foreach ($categories as $category)
						              <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
						          @endforeach
						        </select>
						    </div>
						    <div class="form-group">
						   		<label>Measurement Unit</label>
						        <select class="form-control select2" style="width: 100%;" name="quantity_type">
						          <option selected="selected">- Select Measurement Unit -</option>
						          @foreach ($quantityTypes as $quantityType)
						              <option value="{{ $quantityType->id }}">{{ ucfirst($quantityType->name) }} ({{ $quantityType->acronym }})</option>
						          @endforeach
						        </select>
						    </div>
						    <div class="form-group">
								<label for="product_code">Product Code</label>
								<input type="text" class="form-control" id="product_code" placeholder="Enter Product Code" value="{{ old('product_code') }}" name="product_code">
						    </div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="box box-primary" style="min-height: 430px">
					    <div class="box-header with-border">
							<h4 class="box-title">Menu Subcategories and Ingredients</h4>
					    </div>
					    <div class="box-body">
						    <div class="form-group">
						    	<button class="btn btn-success btn-sm" type="button" onclick="addMenuSubcategory()"><i class="fa fa-plus"></i> Add Another Menu Subcategory and Ingredient
						    	</button>
						    </div>
						    <div class="form-group menu-subcategory">
						    	<div class="row">
							    	<div class="col-sm-2">Subcategory</div>
							    	<div class="col-sm-2">Price (&#8369;)</div>
							    	<div class="col-xs-2">Menu Size ({{ ucfirst($quantityType->name) }}) </div>
							    	<div class="col-sm-2">Ingredient</div>
							    	<div class="col-sm-2">Deduct Per Sale</div>
							    </div>
							    <div class="row submenu" id="submenu-0">
								    <br>
								    <div class="col-sm-2">
								    	<input type="hidden" id="submenuId-0" name="submenuId[0]">
							    	<input type="text" class="form-control" placeholder="Cold" id="subname-0" name="subnames[0]" required="true"></div>
							    	<div class="col-sm-2">
								    	<input type="number" class="form-control" placeholder="100" id="subprice-0" name="subprices[0]" required="true">
								    </div>
								    <div class="col-sm-2">
								    	<input type="number" class="form-control" placeholder="12" id="subquantity-0" name="subquantities[0]" required="true">
								    </div>
								    <div class="col-sm-2">
								        <select class="form-control select2" style="width: 100%;" name="ingNames[0]">
								          <option selected="selected">- Select -</option>
								          @foreach ($ingredients as $ingredient)
								              <option value="{{ $ingredient->id }}">{{ ucfirst($ingredient->name) }} ({{ $ingredient->quantity_type_name }})</option>
								          @endforeach
								        </select>
								    </div>
								    <div class="col-sm-2">
								    	<input type="number" class="form-control" placeholder="100" id="ingPerSale-0" name="ingPerSales[0]" required="true">
								    </div>

								    <div class="col-sm-2">
								    	<button class="btn btn-danger btn-sm" type="button" onclick="removeMenuSubcategory(0)">
								    	<i class="fa fa-minus"></i></button>
								    </div>
							    </div>
							</div>
						</div>
					</div>
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-primary btn-lg">Submit</button>
					</div>
				</div>
		    </form>
		</div>
	</section>
</div>
@endsection

@section('scripts')
<script>
	var newId = 0;
	function addMenuSubcategory() {
		newId = newId + 1;
		$(".menu-subcategory").append('<div class="row submenu" id="submenu-'+newId+'"><br><div class="col-xs-3"><input type="hidden" id="submenuId-'+newId+'" name="submenuId['+newId+']"><input type="text" class="form-control" placeholder="Cold" id="subname-'+newId+'" name="subnames['+newId+']" required="true"></div><div class="col-xs-3"><input type="number" class="form-control" placeholder="100" id="subprice-'+newId+'" name="subprices['+newId+']" required="true"></div><div class="col-xs-3"><input type="number" class="form-control" placeholder="12" id="subquantity-'+newId+'" name="subquantities['+newId+']" required="true"></div><div class="col-xs-2"><button class="btn btn-danger btn-sm" type="button" onclick="removeMenuSubcategory('+newId+')"><i class="fa fa-minus"></i></div>');
	}

	var newIngId = 0;
	function addIngredients() {
		newIngId = newIngId + 1;
		$(".product-ingredient").append('<div class="row ingredient" id="ingredient-'+newIngId+'"><br><div class="col-xs-2"><input type="hidden" id="submenuId-'+newIngId+'" name="ingId['+newIngId+']"><input type="text" class="form-control" placeholder="Coffee Bean" id="ingName-'+newIngId+'" name="ingNames['+newIngId+']" required="true"></div><div class="col-xs-2"><select class="form-control select2" style="width: 100%;" name="ingQuantityTypes['+newIngId+']"><option selected="selected">- Select -</option>@foreach ($quantityTypes as $quantityType)<option value="{{ $quantityType->id }}">{{ ucfirst($quantityType->name) }} ({{ $quantityType->acronym }})</option>@endforeach</select></div><div class="col-xs-2"><input type="number" class="form-control" placeholder="12" id="ingExpect-'+newIngId+'" name="ingExpects['+newIngId+']" required="true"></div><div class="col-xs-2"><input type="number" class="form-control" placeholder="100" id="ingActual-'+newIngId+'" name="ingActuals['+newIngId+']" required="true"></div><div class="col-xs-2"><input type="number" class="form-control" placeholder="100" id="ingPerSale-'+newIngId+'" name="ingPerSales['+newIngId+']" required="true"></div><div class="col-xs-2"><button class="btn btn-danger btn-sm" type="button" onclick="removeIngredient('+newIngId+')"><i class="fa fa-minus"></i></button></div></div>');
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

	var deleteIngKey = 0;
	function removeIngredient(id) {
		if ($('.product-ingredient > div.ingredient').length > 1) {
			var deleteId = $("#ingId-"+id).val();

			if (typeof deleteId != 'undefined') {
				console.log('deleteId'+deleteId);
				$(".product-ingredient").append('<input type="hidden" id="delete-'+deleteIngKey+'" name="deletesIng['+deleteIngKey+']" value="'+deleteId+'">');
				deleteIngKey++;
			}
			$("#ingredient-"+id).remove();
		}
		else {
			alert('Cannot delete last ingredient.');
		}
	}
</script>
@endsection