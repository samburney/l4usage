<!DOCTYPE html>
<html lang="en">
  <head>
    <title>l4quota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{baseURL()}}/lib/bootstrap-3.0.0-wip/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="{{baseURL()}}/js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="{{baseURL()}}/lib/bootstrap-3.0.0-wip/dist/js/bootstrap.min.js" type="text/javascript"></script>
  </head>
  <body>
    {{Former::framework('TwitterBootstrap3')}}
    <div class="container">
      <div class="row">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="navbar-header">
            <a class="navbar-brand" href="{{baseURL()}}">l4quota</a>
          </div>
        </nav>
      </div>
      <div class="row">
        @yield('content')
      </div>
    </div>
  </body>
</html>
