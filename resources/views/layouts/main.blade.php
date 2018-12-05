<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ Config::get('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

</head>
<body class="hold-transition skin-black">
<div class="wrapper">

  <!-- Header -->
  @include('partials.header')

  <!-- Sidebar -->
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  @include('partials.footer')

</div>
<!-- ./wrapper -->

<script src="{{ URL::asset('js/app.js') }}"></script>
<!-- <script src="{{ URL::asset('js/epos-2.3.0.js') }}"></script>
<script src="{{ URL::asset('js/epos-print-editor-en.js') }}"></script> -->
<!-- <script src="{{ URL::asset('js/editor-export.js') }}"></script> -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  @include('partials.scripts')
  @yield('scripts')
</body>
</html>