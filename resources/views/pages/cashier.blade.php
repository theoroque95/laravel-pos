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
          <div class="box box-primary cashier-box">
            <div class="box-header" style="height: 300px; overflow: auto;">
              <table class="table" id="table-receipt">
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
                      <td><strong>&#8369; <span id="receipt-subtotal">0.00</span></strong></td>
                    </tr>
                    <tr>
                      <th>VAT (12%):</th>
                      <td>&#8369; <span id="receipt-vat">0.00</span></td>
                    </tr>
                    <tr>
                      <th>Discount:</th>
                      <td>&#8369; <span id="receipt-discount">0.00</span></td>
                    </tr>
                    <tr>
                      <th>Total:</th>
                      <td>&#8369; <span id="receipt-total">0.00</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="col-xs-6 no-print">
        <div class="box box-primary cashier-box">
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
          <div class="box-body no-padding-top" id="products">
            <h4>2. Select a product</h4>
            <div class="product-wrapper">
            </div>
          </div>
          <div class="box-body no-padding-top" id="submenus">
            <h4>3. Select on the menu</h4>
            <div class="submenu-wrapper">
            </div>
          </div>
          <div class="box-body no-padding-top" id="quantity">
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
            <button type="button" class="btn btn-success" onclick="submitTransaction()"><i class="fa fa-money"></i> Submit Transaction
            </button>
        </div>
      </div>
    </div>
  </section>
</div>
<form action="/cashier" method="POST" style="display: none" id="form-cashier">
  {{ csrf_field() }}
</form>

@include('partials.modalCashier')
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
        $(".box-body#submenus").hide();
        $(".box-body#quantity").hide();
        $(".submenu-wrapper").html("");
        $(".quantity-wrapper").html("");
        $(".btn-category").removeClass('selected');
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
            append += '<a class="btn btn-app btn-menu btn-submenu" onclick="getMenuQuantity('+categoryId+','+productId+','+submenu.id+')" id="btn-submenu-'+submenu.id+'"><i class="fa fa-list-ul"></i><span id="submenu-name">'+submenu.name+'&nbsp;'+submenu.quantity+acronym+'</span> &#8369; <span id="submenu-price">'+parseToPeso(submenu.price)+'</span></a>';
          });
        }
        else {
          append = '<span><i>No submenus available for this product.</i></span>';
        }

        $(".submenu-wrapper").html(append);
        $(".box-body#submenus").show();
        $(".box-body#quantity").hide();
        $(".quantity-wrapper").html("");
        $(".btn-product").removeClass('selected');
        $("#btn-product-"+productId).addClass('selected');
      }
    });
  }

  function getMenuQuantity(categoryId, productId, submenuId) {
    $(".quantity-wrapper").html('<div class="form-group"><input type="number" name="menu-quantity" id="menu-quantity" value="1"></div>');

    $(".box-body#quantity").show();
    $(".btn-submenu").removeClass('selected');
    $("#btn-submenu-"+submenuId).addClass('selected');
  }

  function clearAllItems() {
    $("#receipt-body").html("");
    $("#form-cashier").html('{{ csrf_field() }}');
    item = 0;
    $("#receipt-subtotal").text(parseToPeso(0.00));
    $("#receipt-vat").text(parseToPeso(0.00));
    $("#receipt-total").text(parseToPeso(0.00));
  }

  function addItem() {
    var quantity = $('#menu-quantity').val();

    if (quantity > 0) {
      var price = parseToPeso($('.btn-submenu.selected #submenu-price').text());
      var subtotal = quantity * price;

      // Add to Display Receipt
      $("#receipt-body").append('<tr><td>'+quantity+'</td><td>'+$('.btn-product.selected').text()+'</td><td>'+$('.btn-submenu.selected > #submenu-name').text()+'</td><td>&#8369; '+parseToPeso(subtotal)+'</td></tr>');

      // Add to hidden form for submission
      $("#form-cashier").append('<input type="hidden" name="productSubmenus['+item+']" value="'+$('.btn-submenu.selected').prop('id')+'"><input type="hidden" name="productQuantities['+item+']" value="'+quantity+'">');
      item++;

      // Add to Amount Due Area
      var receiptSubtotal = parseInt($("#receipt-subtotal").text()) + subtotal;
      var vat = receiptSubtotal * 0.12;
      $("#receipt-subtotal").text(parseToPeso(receiptSubtotal));
      $("#receipt-vat").text(parseToPeso(vat));
      $("#receipt-total").text(parseToPeso(receiptSubtotal));

      $(".btn-category").removeClass("selected");
      $(".box-body#products").hide();
      $(".product-wrapper").html("");
      $(".box-body#submenus").hide();
      $(".submenu-wrapper").html("");
      $(".box-body#quantity").hide();
      $(".quantity-wrapper").html("");
    }
    else {
      alert('Quantity must not be greater than 0');
    }
  }

  function showDiscountModal() {
    alert('Feature coming soon!');
  }

  function parseToPeso(number) {
    return parseFloat(Math.round(number * 100) / 100).toFixed(2)
  }

  function submitTransaction() {
    if ($('#receipt-body tr').length > 0) {
      $("#modal-cashier").modal('show');
    }
    else {
      alert('There are no items yet');
    }
  }

  var canvas = document.getElementById('canvas');
  var printer = null;
  var ePosDev = new epson.ePOSDevice();
  function confirmTransaction() {
    alert(ePosDev);
    // Print the receipt
    ePosDev.connect('192.168.192.168', 8008, cbConnect);

    // Finally submit the form then redirect back to cashier with success message
    // $('#form-cashier').submit();
  }

  function cbConnect(data) {
        if(data == 'OK' || data == 'SSL_CONNECT_OK') {
            ePosDev.createDevice('local_printer', ePosDev.DEVICE_TYPE_PRINTER,
                                  {'crypto':false, 'buffer':false}, cbCreateDevice_printer);
        } else {
            alert(data);
        }
  }

  function cbCreateDevice_printer(devobj, retcode) {
      if( retcode == 'OK' ) {
          printer = devobj;
          printer.timeout = 60000;
          printer.onreceive = function (res) { alert(res.success); };
          printer.oncoveropen = function () { alert('coveropen'); };
          print();
      } else {
          alert(retcode);
      }
  }

  function print() {
    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addTextDouble(true, true);
    printer.addText('\nCoffee Crib\n');
    printer.addTextDouble(false, false);
    printer.addTextFont(printer.FONT_A);
    printer.addText('Optd By: Vincent Theo Roque\nBrgy. Wawa, Balagtas, Bulacan\n VAT Reg TIN: 000-000-000-0000\nSerial No. 0011223344\n\n\n\n');
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText('Official Receipt #: 0011223344\nCashier: Puti\nOrder #: 0011\n---------------------------------\nQty\tDescription(s)\tPrice\n---------------------------------\n');
    printer.addText('CHOCOLATE MINT 16oz\n\t1 @70.00\t70.00\n---------------------------------\n');
    printer.addText('TOTAL\t\t\t70.00\nCASH\t\t\t100.00\nCHANGE\t\t\t30.00\n---------------------------------\n');
    printer.addText('VAT SALES\t\t62.50\nVAT 12%\t\t\t7.50\nNon VAT Sales\t\t0.00\nVAT Exempt\t\t0.00\nZero Rated\t\t0.00\nTotal\t\t\t70.00\n---------------------------------\n');
    printer.addText('Total Items: 1\n---------------------------------\n');
    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addText('2017/08/21 9:30:33 PM\n');
    printer.send();

    // Finally submit the form then redirect back to cashier with success message
    $('#form-cashier').submit();
  }
</script>
@endsection