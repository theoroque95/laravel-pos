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
                    <tr>
                      <th>Tendered:</th>
                      <td>&#8369; <span id="receipt-tendered">0.00</span></td>
                    </tr>
                    <tr>
                      <th>Change:</th>
                      <td>&#8369; <span id="receipt-change">0.00</span></td>
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
              <button class="btn btn-app btn-menu btn-category" onclick="getMenuProducts({{ $category->id }})" id="btn-category-{{ $category->id }}">
                <i class="fa fa-list-ul"></i> {{ ucfirst($category->name) }}
              </button>
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
            <button type="button" class="btn btn-success pull-right" onclick="addItem()"><i class="fa fa-plus"></i> Add Item
            </button>
          </div>
        </div>
        <div class="box-body" style="text-align: right;">
            <button type="button" class="btn btn-info btn-menu-action" onclick="showDiscountModal()"><i class="fa fa-percent"></i> Apply Discount
            </button>
            <button type="button" class="btn btn-danger btn-menu-action" onclick="clearAllItems()"><i class="fa fa-trash"></i> Clear Items
            </button>
            <button type="button" class="btn btn-success btn-menu-action" onclick="submitTransaction()"><i class="fa fa-money"></i> Finalize Transaction
            </button>
            <br><br>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-void"><i class="fa fa-minus-square-o"></i> Void Sale
            </button>
            <button type="button" class="btn btn-success" onclick="newSale()"><i class="fa fa-plus-square-o"></i> New Sale
            </button>
        </div>
      </div>
    </div>
  </section>
</div>
<form action="/cashier" method="POST" style="display: none" id="form-cashier">
  {{ csrf_field() }}
</form>
@foreach($ingredients as $ingredient)
<input type="hidden" name="ingredient-{{ $ingredient->id }}" id="ingredient-{{ $ingredient->id }}" actual="{{ $ingredient->actual_quantity }}">
@endforeach

@include('partials.modalCashier')
@include('partials.modalVoid')
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
            append += '<button class="btn btn-app btn-menu btn-product" onclick="getMenuSubmenus('+id+','+product.id+')" id="btn-product-'+product.id+'"><i class="fa fa-list-ul"></i>'+product.name+'</button>';
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
        var ingredients = response.ingredients;
        var saleQuantity = response.saleQuantity;
        var append = "";

        if (submenus != "") {
          $.each(submenus, function(key, submenu) {
            append += '<button class="btn btn-app btn-menu btn-submenu" onclick="getMenuQuantity('+categoryId+','+productId+','+submenu.id+')" id="btn-submenu-'+submenu.id+'" ingredients="'+ingredients[key]+'" saleQuantity="'+saleQuantity[key]+'"><i class="fa fa-list-ul"></i><span id="submenu-name">'+submenu.name+'&nbsp;'+submenu.quantity+acronym+'</span> &#8369; <span id="submenu-price">'+parseToPeso(submenu.price)+'</span></button>';
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
    var add = true;
    var available = 0;

    if (quantity > 0) {
      var productIngredients = ($('.btn-submenu.selected').attr('ingredients')).split(',');
      var saleQuantity = ($('.btn-submenu.selected').attr('salequantity')).split(',');

      $.each(productIngredients, function(key, productIngredient) {
        var actual = parseFloat($('#ingredient-'+productIngredient).attr('actual'));
        var productSaleQuantity = parseFloat(saleQuantity[key]);
        var deduct = quantity * productSaleQuantity;

        if ((actual - deduct) > 0) {
          add = true;
        }
        else {
          available = parseInt(actual/productSaleQuantity);
          add = false;
          return false;
        }

      });

      if (add == true) {
        var price = parseFloat($('.btn-submenu.selected #submenu-price').text());
        var subtotal = quantity * price;

        // Add to Display Receipt
        $("#receipt-body").append('<tr><td>'+quantity+'</td><td>'+$('.btn-product.selected').text()+'</td><td>'+$('.btn-submenu.selected > #submenu-name').text()+'</td><td>&#8369; '+subtotal+'</td></tr>');

        // Add to hidden form for submission
        $("#form-cashier").append('<input type="hidden" name="productSubmenus['+item+']" value="'+$('.btn-submenu.selected').prop('id')+'"><input type="hidden" name="productQuantities['+item+']" value="'+quantity+'">');
        item++;

        // Add to Amount Due Area
        var receiptSubtotal = parseFloat($("#receipt-subtotal").text()) + subtotal;
        var tendered = parseFloat($("#receipt-tendered").text());

        setAmountDue(receiptSubtotal, tendered);

        $(".btn-category").removeClass("selected");
        $(".box-body#products").hide();
        $(".product-wrapper").html("");
        $(".box-body#submenus").hide();
        $(".submenu-wrapper").html("");
        $(".box-body#quantity").hide();
        $(".quantity-wrapper").html("");

        $.each(productIngredients, function(key, productIngredient) {
          var actual = parseFloat($('#ingredient-'+productIngredient).attr('actual'));
          var newActual = (actual - (quantity * parseFloat(saleQuantity[key])));

          $('#ingredient-'+productIngredient).attr('actual', newActual);
        });
      }
      else if (available == 0) {
        alert('The ingredient/s of this product is out of stock.');
      }
      else {
        alert('Only '+available+' of this product is available.');
      }

    }
    else {
      alert('Quantity must not be greater than 0');
    }
  }

  function showDiscountModal() {
    alert('Feature coming soon!');
  }

  function setAmountDue(receiptSubtotal, tendered) {
    var vat = receiptSubtotal * 0.12;
    var change = tendered - receiptSubtotal;
    change = change < 0 ? 0 : change;

    $("#receipt-subtotal").text(parseToPeso(receiptSubtotal));
    $("#receipt-vat").text(parseToPeso(vat));
    $("#receipt-total").text(parseToPeso(receiptSubtotal));
    $("#receipt-tendered").text(parseToPeso(tendered));
    $("#receipt-change").text(parseToPeso(change));
  }

  function submitTransaction() {
    if ($('#receipt-body tr').length > 0) {
      $("#modal-total").text(parseToPeso(parseFloat($("#receipt-total").text())));
      $("#modal-cashier").modal('show');
    }
    else {
      alert('There are no items yet');
    }
  }

  var canvas = document.getElementById('canvas');
  var printer = null;
  var ePosDev = new epson.ePOSDevice();

  var gCashier, gNoOfItems, gOrderNo, gReceiptNo, gTendered, gTotal, gVat;
  var gProductDetails = [];
  var gProducts = [];
  var gProductQuantities = [];

  function confirmTransaction() {
    // Disable all menu button to prevent adding items upon finalize
    var tendered = parseFloat($("#modal-tendered").val());
    var total = parseFloat($("#receipt-total").text());
    var change = tendered - total;

    $("#modal-tendered").val("");
    if (tendered == "") {
      $("#payment-error-message").text('Cannot be empty');
      $("#payment-error").fadeIn();
    }
    else if (tendered == 0) {
      $("#payment-error-message").text('Must be greater than P0.00');
      $("#payment-error").fadeIn();
    }
    else if (tendered < total) {
      $("#payment-error-message").html('Must be greater than Total: P'+total);
      $("#payment-error").fadeIn();
    }
    else {
      $("#payment-error").fadeOut();
      $("#receipt-tendered").text(parseToPeso(tendered));
      $("#receipt-change").text(parseToPeso(change));
      $("#modal-cashier").modal('hide');

      // Add tendered to input hidden
      $("#form-cashier").append('<input type="hidden" name="tendered" value="'+parseToPeso(tendered)+'">');

      var productSubmenus = [];
      var productQuantities = [];
      $('input[name^="productSubmenus"]').each(function() {
        productSubmenus.push($(this).val());
      });
      $('input[name^="productQuantities"]').each(function() {
        productQuantities.push($(this).val());
      });

      // Submit to ajax; print if success
      $.ajax({
        url : '/cashier',
        method: 'POST',
        type: 'json',
        data: {
            _token: $("#form-cashier input[name='_token']").val(),
            productSubmenus: productSubmenus,
            productQuantities: productQuantities,
            tendered: parseToPeso(tendered),
            total: parseToPeso($("#receipt-total").text()),
            vat: parseToPeso($("#receipt-vat").text())
        },
        success : function(response) {
          console.log(response);
          $('.btn-menu').attr({'disabled':true});
          $('.btn-menu-action').attr({'disabled':true});

          gCashier = response.cashier;
          gNoOfItems = response.noOfItems;
          gOrderNo = response.order_no;
          gReceiptNo = response.receipt_no;
          gTendered = response.tendered;
          gTotal = response.total;
          gVat = response.vat;

          gProductDetails = (response.productDetails).slice(0);
          gProducts = (response.products).slice(0);
          gProductQuantities = (response.productQuantities).slice(0);

          // FINALLY: Print the receipt
          ePosDev.connect('192.168.192.168', 8008, cbConnect);
        }
      });
    }
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
    printer.addText('\n{{ Config::get("client.name") }}\n');
    printer.addTextDouble(false, false);
    printer.addTextFont(printer.FONT_A);
    printer.addText('Optd By: Vincent Theo Roque\n{{ Config::get("client.address") }}\n VAT Reg TIN: {{ Config::get("client.tin") }}\nSerial No. {{ Config::get("client.serial") }}\n\n\n\n');
    printer.addTextAlign(printer.ALIGN_LEFT);
    printer.addText('Official Receipt #: '+gReceiptNo+'\nCashier: '+gCashier+'\nOrder #: '+gOrderNo+'\n---------------------------------\nQty\tDescription(s)\tPrice\n---------------------------------\n');

    $.each(gProducts, function(key, product) {
      printer.addText(product.name.toUpperCase()+' '+gProductDetails[key].name+' '+gProductDetails[key].quantity+product.acronym+'\n\t'+gProductQuantities[key]+' @'+parseToPeso(gProductDetails[key].price)+'\t'+parseToPeso(parseFloat(gProductQuantities[key])*parseFloat(gProductDetails[key].price))+'\n---------------------------------\n');
    });

    printer.addText('TOTAL\t\t\t'+gTotal+'\nCASH\t\t\t'+gTendered+'\nCHANGE\t\t\t'+(gTendered-gTotal)+'\n---------------------------------\n');
    printer.addText('VAT SALES\t\t'+(gTotal-gVat)+'\nVAT 12%\t\t\t'+gVat+'\nNon VAT Sales\t\t0.00\nVAT Exempt\t\t0.00\nZero Rated\t\t0.00\nTotal\t\t\t'+gTotal+'\n---------------------------------\n');
    printer.addText('Total Items: '+gNoOfItems+'\n---------------------------------\n');
    printer.addTextAlign(printer.ALIGN_CENTER);
    printer.addText(formatDateCashier(new Date())+'\n');
    printer.addPulse(printer.DRAWER_1, printer.PULSE_100);
    printer.send();
  }

  function voidSale() {
    $.ajax({
        url : '/cashier/void',
        method: 'POST',
        type: 'json',
        data: {
            _token: $("#modal-void input[name='_token']").val(),
            orderNo: $("#modal-orderno").val(),
            password: $("#modal-password").val()
        },
        success : function(response) {
          $("#void-notif").addClass("alert-success");
          $("#void-notif").removeClass("alert-danger");
          $("#void-notif-message").html(response.notification);
          $("#void-notif").fadeIn();
        },
        error : function(error) {
          $("#void-notif-message").html(error.responseJSON.error);
          $("#void-notif").removeClass("alert-success");
          $("#void-notif").addClass("alert-danger");
          $("#void-notif").fadeIn();
        }
      });
  }

  function newSale() {
    $('.btn-menu-action').removeAttr('disabled');
    $('.btn-menu').removeAttr('disabled');
    clearAllItems();
    $("#receipt-tendered").text(parseToPeso(0));
    $("#receipt-change").text(parseToPeso(0));
  }

  function formatDateCashier(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    var month = ('0' + (date.getMonth()+1)).slice(-2);
    var day = ('0' + (date.getDate())).slice(-2);
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return date.getFullYear() + "/" + month + "/" + day + " " + strTime;
  }
</script>
@endsection