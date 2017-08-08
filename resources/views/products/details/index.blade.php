@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/details/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Product</button></a>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Product Details</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Availability in Percentage (%)</th>
                <th>Availability in Numbers (/)</th>
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
                  <td>
                    <div class="progress progress-md">
                      @if ($product->available_amount <= 5)
                        <div class="progress-bar progress-bar-danger" style="width: {{ $product->available_amount }}%"></div>
                      @elseif ($product->available_amount <= 20)
                        <div class="progress-bar progress-bar-yellow" style="width: {{ $product->available_amount }}%"></div>
                      @else
                        <div class="progress-bar progress-bar-success" style="width: {{ $product->available_amount }}%"></div>
                      @endif
                    </div>
                  </td>
                  <td>
                    @if ($product->available_amount <= 5)
                      <span class="badge bg-red badge-md">{{ $product->actual_quantity }}/{{ $product->expected_quantity }}</he>
                    @elseif ($product->available_amount <= 20)
                      <span class="badge bg-yellow badge-md">{{ $product->actual_quantity }}/{{ $product->expected_quantity }}</span>
                    @else
                      <span class="badge bg-green badge-md">{{ $product->actual_quantity }}/{{ $product->expected_quantity }}</span>
                    @endif
                  </td>
                  <td>{{ $product->quantity_type_name }} ({{ $product->acronym }})</td>
                  <td>
                    <div class="btn-group">
                      <a href="/details/{{ $product->id }}"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Product</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the product?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection