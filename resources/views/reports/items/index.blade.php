@extends('layouts.main')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="pull-left">
    <a href="/items" class="btn btn-info">All</a>
      <a href="/items?table=month" class="btn btn-info">Month</a>
      <a href="/items?table=week" class="btn btn-info">Week</a>
      <a href="/items?table=day" class="btn btn-info">Day</a>
    </div>
    <div class="pull-right">
      <span style="color: white; font-size: 18px; font-weight: 600;">
        <span class="label label-success">Top 1: {{ $top[0]->product }}</span> &nbsp; | &nbsp;
        <span class="label label-info">Top 2: {{ $top[1]->product }}</span> &nbsp; | &nbsp;
        <span class="label label-warning">Top 3: {{ $top[2]->product }}</span> &nbsp; | &nbsp;
        <span class="label label-danger">Top 4: {{ $top[3]->product }}</span> &nbsp; | &nbsp;
        <span class="label label-danger">Top 5: {{ $top[4]->product }}</span> &nbsp;
      </span>
      <button type="button" class="btn btn-success"><i class="fa fa-printer"></i> Print Report</button>
    </div>
  </section>
  <section class="content">
    @include('partials.notification')
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Items Sold Table {{ $table != null ? '('.ucfirst($table).')' : ''}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data-table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Order No.</th>
                <th>Receipt No.</th>
                <th>Cashier</th>
                <th>Product</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Price</th>
                <th>Date</th>
              </tr>
              </thead>
              <tbody>
              @foreach($items as $item)
                <tr>
                  <td>{{ $item->order_no }}</td>
                  <td>{{ $item->receipt_no }}</td>
                  <td>{{ $item->first_name }}</td>
                  <td>{{ $item->product }}</td>
                  <td>{{ $item->category }}</td>
                  <td>{{ $item->subcategory }} {{ $item->acronym }}</td>
                  <td>&#8369; {{ $item->price }}</td>
                  <td>{{ $item->created_at->addHours(8)->format('F j, Y, g:i a') }}</td>
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
@endsection