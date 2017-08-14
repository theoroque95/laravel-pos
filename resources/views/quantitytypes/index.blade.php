@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/quantitytypes/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Quantity Type</button></a>
  </section>
  <section class="content">
    @include('partials.notification')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Quantity Types</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Acronym</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($quantityTypes as $quantityType)
                <tr>
                  <td>{{ $quantityType->name }}</td>
                  <td>{{ $quantityType->description }}</td>
                  <td>{{ $quantityType->acronym }}</td>
                  <td>
                    <div class="btn-group">
                      <a href="/quantitytypes/{{ $quantityType->id }}"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" data-id="{{ $quantityType->id }}" data-form="quantity"><i class="fa fa-trash"></i></button>
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