@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header pull-right">
    <a href="/discounts/add"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add New Discount</button></a>
  </section>
  <section class="content">
    @include('partials.notification')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Discounts</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Percentage (%)</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($discounts as $discount)
                <tr>
                  <td>{{ $discount->name }}</td>
                  <td>{{ $discount->description }}</td>
                  <td>{{ $discount->percentage }}</td>
                  <td>
                    <div class="btn-group-inline">
                      <a href="/discounts/{{ $discount->id }}"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete" data-id="{{ $discount->id }}" data-form="discount"><i class="fa fa-trash"></i></button>
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