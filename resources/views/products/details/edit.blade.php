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
			<form role="form" method="POST" action="/details/edit/{{$product->id}}">
			    {{ csrf_field() }}
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title"><i class="fa fa-plus"></i> Edit Product</h3>
						</div>
						<div class="box-body">
						  	<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" placeholder="Enter Name" value="{{ $product->name }}" name="name" required="true">
						    </div>
						    <div class="form-group">
								<label for="description">Description</label>
								<input type="text" class="form-control" id="description" placeholder="Enter Description" value="{{ $product->description }}" name="description" required="true">
						    </div>
						    <div class="form-group">
						   		<label>Category</label>
						        <select class="form-control select2" style="width: 100%;" name="category">
						          <option selected="selected">- Select Category -</option>
						          @foreach ($categories as $category)
						              <option value="{{ $category->id }}" class="{{ $category->name }}">{{ ucfirst($category->name) }}</option>
						          @endforeach
						        </select>
						    </div>
						    <div class="form-group">
						   		<label>Measurement Unit</label>
						        <select class="form-control select2" style="width: 100%;" name="quantity_type" class="quantity_type">
						          <option selected="selected">- Select Measurement Unit -</option>
						          @foreach ($quantityTypes as $quantityType)
						              <option value="{{ $quantityType->id }}" class="{{ $quantityType->name }}">{{ ucfirst($quantityType->name) }} ({{ $quantityType->acronym }})</option>
						          @endforeach
						        </select>
						    </div>
						    <div class="form-group">
								<label for="product_code">Product Code</label>
								<input type="text" class="form-control" id="product_code" placeholder="Enter Product Code" value="{{ $product->product_code }}" name="product_code">
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
							    	<div class="col-sm-2">Menu Size ({{ ucfirst($quantityType->name) }}) </div>
							    	<div class="col-sm-2">Price (&#8369;)</div>
							    	<div class="col-sm-1"></div>
							    	<div class="col-sm-2 no-padding-left">Ingredient</div>
							    	<div class="col-sm-2">Deduct per Sale</div>
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
	$("option.{{ $product->quantity_type_name }}").attr('selected', 'selected');
	$("option.{{ $product->category_name }}").attr('selected', 'selected');

	var newId = 0;
	function addMenuSubcategory() {
		newId = newId + 1;
		$(".menu-subcategory").append('<div class="row submenu" id="submenu-'+newId+'"><br><div class="col-sm-2"><input type="hidden" id="submenuId-'+newId+'" name="submenuId['+newId+']"><input type="text" class="form-control" placeholder="Cold" id="subname-0" name="subnames['+newId+']" required="true"></div><div class="col-sm-2"><input type="number" class="form-control" placeholder="12" id="subquantity-'+newId+'" name="subquantities['+newId+']" required="true"></div><div class="col-sm-2"><input type="number" class="form-control" placeholder="100" id="subprice-'+newId+'" name="subprices['+newId+']" required="true"></div><div class="col-sm-1 no-padding-right"><button class="btn btn-danger btn-sm" type="button" onclick="removeMenuSubcategory('+newId+')"><i class="fa fa-minus"></i></button></div><div class="col-sm-5 category-ingredient-'+newId+'"><div class="row ingredient-0"><div class="col-sm-5 no-padding-left"><select class="form-control select2" style="width: 100%;" name="ingNames['+newId+'][0]"><option selected="selected">- Select Ingredient -</option>@foreach ($ingredients as $ingredient)<option value="{{ $ingredient->id }}">{{ ucfirst($ingredient->name) }} ({{ $ingredient->quantity_type_name }})</option>@endforeach</select></div><div class="col-sm-4 no-padding-right no-padding-left"><input type="number" class="form-control" placeholder="Deduct per sale" id="ingPerSale-'+newId+'-0" name="ingPerSales['+newId+'][0]" required="true"></div><div class="col-sm-3 no-padding-right"><button class="btn btn-danger btn-sm" type="button" onclick="removeIngredient('+newId+',0)"><i class="fa fa-minus"></i></button> <button class="btn btn-success btn-sm btn-add-'+newId+'" type="button" onclick="addIngredient('+newId+',0)"><i class="fa fa-plus"></i></button></div></div></div></div>')
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

	function addIngredient(categoryId, ingredientId) {
		ingredientId = ingredientId + 1;
		$(".category-ingredient-"+categoryId).append('<div class="row ingredient-'+ingredientId+'"><div class="col-sm-5 no-padding-left"><select class="form-control select2" style="width: 100%;" name="ingNames['+categoryId+']['+ingredientId+']"><option selected="selected">- Select Ingredient -</option>@foreach ($ingredients as $ingredient)<option value="{{ $ingredient->id }}">{{ ucfirst($ingredient->name) }} ({{ $ingredient->quantity_type_name }})</option>@endforeach</select></div><div class="col-sm-4 no-padding-right no-padding-left"><input type="number" class="form-control" placeholder="Deduct per sale" id="ingPerSale-'+categoryId+'-'+ingredientId+'" name="ingPerSales['+categoryId+']['+ingredientId+']" required="true"></div><div class="col-sm-3 no-padding-right"><button class="btn btn-danger btn-sm" type="button" onclick="removeIngredient('+categoryId+','+ingredientId+')"><i class="fa fa-minus"></i></button></div></div>');
		$('.btn-add-'+categoryId).attr('onclick','addIngredient('+categoryId+','+ingredientId+')');
	}

	var ingDeleteKey = 0;
	function removeIngredient(categoryId, ingredientId) {
		if ($('.category-ingredient-'+categoryId+' > div.row').length > 1) {
			var deleteId = $("#ingredient-"+ingredientId).val();
			if (typeof deleteId != 'undefined') {
				console.log('deleteId: '+deleteId);
				$('.category-ingredient-'+categoryId).append('<input type="hidden" id="ingDelete-'+ingDeleteKey+'" name="ingDeletes['+ingDeleteKey+']" value="'+deleteId+'">');
				ingDeleteKey++;
			}
			$('.category-ingredient-'+categoryId+' > .ingredient-'+ingredientId).remove();
		}
		else {
			alert('Cannot delete last ingredient of this category.');
		}
	}
</script>
	@foreach($productSubmenus as $productSubmenu)
	<script>
	$(".menu-subcategory").append('<div class="row submenu" id="submenu-'+newId+'"><br><div class="col-sm-2"><input type="hidden" id="submenuId-'+newId+'" name="submenuId['+newId+']"><input type="text" class="form-control" placeholder="Cold" id="subname-'+newId+'" name="subnames['+newId+']" required="true" value="{{ $productSubmenu->name }}"></div><div class="col-sm-2"><input type="number" class="form-control" placeholder="12" id="subquantity-'+newId+'" name="subquantities['+newId+']" required="true" value="{{ $productSubmenu->quantity }}"></div><div class="col-sm-2"><input type="number" class="form-control" placeholder="100" id="subprice-'+newId+'" name="subprices['+newId+']" required="true" value="{{ $productSubmenu->price }}"></div><div class="col-sm-1 no-padding-right"><button class="btn btn-danger btn-sm" type="button" onclick="removeMenuSubcategory('+newId+')"><i class="fa fa-minus"></i></button></div><div class="col-sm-5 category-ingredient-'+newId+'"></div></div>');

		var ingId = 0;
		@foreach($productSubmenu->ingredients as $productIngredient)
			var appendText = '<div class="row ingredient-'+ingId+'"><div class="col-sm-5 no-padding-left"><select class="form-control select2" style="width: 100%;" name="ingNames['+newId+']['+ingId+']"><option selected="selected">- Select Ingredient -</option>@foreach ($ingredients as $ingredient)<option value="{{ $ingredient->id }}" class="{{ $ingredient->id }}">{{ ucfirst($ingredient->name) }} ({{ $ingredient->quantity_type_name }})</option>@endforeach</select></div><div class="col-sm-4 no-padding-right no-padding-left"><input type="number" class="form-control" placeholder="Deduct per sale" id="ingPerSale-'+newId+'-'+ingId+'" name="ingPerSales['+newId+']['+ingId+']" required="true" value="{{ $productIngredient->pivot->sale_quantity }}"></div><div class="col-sm-3 no-padding-right"><button class="btn btn-danger btn-sm" type="button" onclick="removeIngredient('+newId+','+ingId+')"><i class="fa fa-minus"></i></button>';

			if (ingId == 0) {
				appendText += ' <button class="btn btn-success btn-sm btn-add-'+newId+'" type="button" onclick="addIngredient('+newId+','+ingId+')"><i class="fa fa-plus"></i></button>';
			}

			appendText += '</div></div>';
			$(".category-ingredient-"+newId).append(appendText);

			$(".category-ingredient-"+newId+" .ingredient-"+ingId+" select .{{ ucfirst($productIngredient->id) }}").attr('selected', 'selected');
			ingId++;
		@endforeach
		newId++;
	</script>
	@endforeach
@endsection