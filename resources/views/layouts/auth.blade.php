<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ Config::get('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/app.css">

</head>
<body class="hold-transition auth-page">

  <!-- Content -->
  @yield('content')

  <!-- jQuery 3 -->
  <script src="js/app.js"></script>
</body>
</html>