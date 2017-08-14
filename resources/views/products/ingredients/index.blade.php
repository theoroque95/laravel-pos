@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/ingredients/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Ingredient</button></a>
  </section>
  <section class="content">
    @include('partials.notification')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Ingredient Details</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity (Percentage %)</th>
                <th>Quantity (Numbers)</th>
                <th>Measurement</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($ingredients as $ingredient)
                <tr>
                  <td>{{ $ingredient->name }}</td>
                  <td>{{ $ingredient->description }}</td>
                  <td>
                    <div class="progress progress-md">
                      @if ($ingredient->available_amount <= 5)
                        <div class="progress-bar progress-bar-danger" style="width: {{ $ingredient->available_amount }}%"></div>
                      @elseif ($ingredient->available_amount <= 20)
                        <div class="progress-bar progress-bar-yellow" style="width: {{ $ingredient->available_amount }}%"></div>
                      @else
                        <div class="progress-bar progress-bar-success" style="width: {{ $ingredient->available_amount }}%"></div>
                      @endif
                    </div>
                  </td>
                  <td>
                    @if ($ingredient->available_amount <= 5)
                      <span class="badge bg-red badge-md">{{ $ingredient->actual_quantity }}/{{ $ingredient->expected_quantity }}</he>
                    @elseif ($ingredient->available_amount <= 20)
                      <span class="badge bg-yellow badge-md">{{ $ingredient->actual_quantity }}/{{ $ingredient->expected_quantity }}</span>
                    @else
                      <span class="badge bg-green badge-md">{{ $ingredient->actual_quantity }}/{{ $ingredient->expected_quantity }}</span>
                    @endif
                  </td>
                  <td>{{ $ingredient->quantity_type_name }} ({{ $ingredient->acronym }})</td>
                  <td>
                    <div class="btn-group">
                      <a href="/ingredients/{{ $ingredient->id }}"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" data-id="{{ $ingredient->id }}" data-form="ingredient"><i class="fa fa-trash"></i></button>
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