@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header no-padding-bottom">
    <h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-television"></i> Cashier</li>
      </ol>
    </h1>
  </section>

  <section class="content no-padding-top">
    @include('partials.notification')
    <div class="row">
      <!-- left column -->
      <div class="col-xs-6">
        <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header" style="height: 300px; overflow: auto;">
              <table class="table">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody id="receipt-body">

                </tbody>
              </table>
            </div>

            <div class="box-body">
              <p class="lead">Amount Due</p>

              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>$250.30</td>
                    </tr>
                    <tr>
                      <th>VAT (12%)</th>
                      <td>$10.34</td>
                    </tr>
                    <tr>
                      <th>Discount</th>
                      <td>0.00</td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>$265.24</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="col-xs-6 no-print">
        <div class="box box-primary">
          <div class="box-body" id="categories">
            <h4>1. Select a category</h4>
            <div class="category-wrapper">
            @foreach($categories as $category)
              <a class="btn btn-app btn-menu btn-category" onclick="getMenuProducts({{ $category->id }})" id="btn-category-{{ $category->id }}">
                <i class="fa fa-list-ul"></i> {{ ucfirst($category->name) }}
              </a>
            @endforeach
            </div>
          </div>
          <div class="box-body" id="products">
            <h4>2. Select a product</h4>
            <div class="product-wrapper">
            </div>
          </div>
          <div class="box-body" id="submenus">
            <h4>3. Select on the menu</h4>
            <div class="submenu-wrapper">
            </div>
          </div>
          <div class="box-body" id="quantity">
            <h4>4. Input quantity</h4>
            <div class="quantity-wrapper">
            </div>
            <button type="button" class="btn btn-success pull-right" onclick="addItem()"><i class="fa fa-plus"></i> Add Product
            </button>
          </div>
        </div>
        <div class="box-body pull-right">
            <button type="button" class="btn btn-info" onclick="showDiscountModal()"><i class="fa fa-percent"></i> Apply Discount
            </button>
            <button type="button" class="btn btn-danger" onclick="clearAllItems()"><i class="fa fa-trash"></i> Void All Items
            </button>
            <button type="button" class="btn btn-success" onclick="submitTransaction()"><i class="fa fa-credit-card"></i> Submit Transaction
            </button>
        </div>
      </div>
    </div>
  </section>
</div>
<form action="/cashier/submit" method="POST" style="display: none" id="form-cashier">
  {{ csrf_field() }}
</form>
@endsection

@section('scripts')
<script>
  var item = 0;

  function getMenuProducts(id) {
    $.ajax({
      url : '/cashier/menu-products',
      method: 'GET',
      type: 'json',
      data: {
          categoryId: id
      },
      success : function(response) {
        var products = response.products;
        var append = "";

        if (products != "") {
          $.each(products, function(key, product) {
            append += '<a class="btn btn-app btn-menu btn-product" onclick="getMenuSubmenus('+id+','+product.id+')" id="btn-product-'+product.id+'"><i class="fa fa-list-ul"></i>'+product.name+'</a>';
          });
        }
        else {
          append = '<span><i>No products available for this category.</i></span>';
        }

        $(".product-wrapper").html(append);
        $(".box-body#products").show();
        $(".submenu-wrapper").html("");
        $(".quantity-wrapper").html("");
        $("#btn-category-"+id).addClass('selected');
      }
    });
  }

  function getMenuSubmenus(categoryId, productId) {
    $.ajax({
      url : '/cashier/menu-submenus',
      method: 'GET',
      type: 'json',
      data: {
          productId: productId
      },
      success : function(response) {
        var submenus = response.submenus;
        var acronym = response.acronym;
        var append = "";

        if (submenus != "") {
          $.each(submenus, function(key, submenu) {
            append += '<a class="btn btn-app btn-menu btn-submenu" onclick="getMenuQuantity('+categoryId+','+productId+','+submenu.id+')" id="btn-submenu-'+submenu.id+'"><i class="fa fa-list-ul"></i><span id="submenu-name">'+submenu.name+'&nbsp;'+submenu.quantity+acronym+'</span> &#8369<span id="submenu-price">'+submenu.price+'</span></a>';
          });
        }
        else {
          append = '<span><i>No submenus available for this product.</i></span>';
        }

        $(".submenu-wrapper").html(append);
        $(".box-body#submenus").show();
        $(".quantity-wrapper").html("");
        $("#btn-product-"+productId).addClass('selected');
      }
    });
  }

  function getMenuQuantity(categoryId, productId, submenuId) {
    $(".quantity-wrapper").html('<div class="form-group"><input type="number" name="menu-quantity" id="menu-quantity" value="1"></div>');

    $(".box-body#quantity").show();
    $("#btn-submenu-"+submenuId).addClass('selected');
  }

  function clearAllItems() {
    $("#receipt-body").html("");
    $("#form-cashier").html('{{ csrf_field() }}');
  }

  function addItem() {
    var quantity = $('#menu-quantity').val();
    var price = $('#submenu-price').text();
    var subtotal = quantity * price;

    // Add to Display Receipt
    $("#receipt-body").append('<tr><td>'+quantity+'</td><td>'+$('.btn-product.selected').text()+'</td><td>'+$('.btn-submenu.selected > #submenu-name').text()+'</td><td>&#8369;'+subtotal+'</td></tr>');

    // Add to hidden form for submission
    $("#form-cashier").append('<input type="hidden" name="productSubmenus['+item+']" value="'+$('.btn-submenu.selected').prop('id')+'">');
    item++;

    $(".btn-category").removeClass("selected");
    $(".box-body#products").hide();
    $(".product-wrapper").html("");
    $(".box-body#submenus").hide();
    $(".submenu-wrapper").html("");
    $(".box-body#quantity").hide();
    $(".quantity-wrapper").html("");
  }

  function showDiscountModal() {
    alert('Feature coming soon!');
  }
</script>
@endsection