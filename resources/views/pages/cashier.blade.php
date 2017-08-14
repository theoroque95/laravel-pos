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
                  <th>Code</th>
                  <th>Description</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody id="receipt">
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Mocha Frappe</td>
                  <td>MCHFRP</td>
                  <td>Cold 12oz</td>
                  <td>&#8369;90.00</td>
                </tr>
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
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-body" id="categories">
            <h4>Select a category</h4>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Category 1
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Category 2
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Category 3
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Category 4
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Category 5
            </a>
          </div>
          <div class="box-body" id="products">
            <h4>Select a product</h4>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Product 1
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Product 2
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Product 3
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Product 4
            </a>
            <a class="btn btn-app">
              <i class="fa fa-edit"></i> Product 5
            </a>
          </div>
          <div class="box-body no-print">
            <a target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection