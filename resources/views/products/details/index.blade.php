@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/details/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Product</button></a>
  </section>
  <section class="content">
    @include('partials.notification')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Product Details</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Measurement</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($products as $product)
                <tr>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ ucfirst($product->category_name) }}</td>
                  <td>{{ $product->quantity_type_name }} ({{ $product->acronym }})</td>
                  <td>
                    <div class="btn-group">
                      <a href="/details/{{ $product->id }}"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" data-id="{{ $product->id }}" data-form="product"><i class="fa fa-trash"></i></button>
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>
@include('partials.modalDelete')
@endsection