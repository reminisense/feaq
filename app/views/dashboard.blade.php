<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>FeatherQ 4.5</title>
  <meta name="title" content="FeatherQ Online Queueing software" />
  <meta name="description" content="FeatherQ online Queueing software" />
  <meta name="author" content="">
  <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <link rel="shortcut icon" id="favicon" href="favicon.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel='stylesheet' type='text/css' href='/css/global.css'>
  <link rel='stylesheet' type='text/css' href='/css/responsive.css'>

      @yield('styles')

  <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
  <script src="/js/ngFeatherQ.js"></script>
  <script src="/js/ngFacebook.js"></script>
  <script src="/js/ngAutocomplete.js"></script>


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]-->
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body ng-app="FeatherQ">
  <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="" class="navbar-brand"><img src="/img/featherq-logo.svg"></a>
      </div>
      <nav class="pull-right collapse navbar-collapse bs-navbar-collapse" role="navigation">
        <ul class="nav navbar-nav">
          <li id="search-business" class="active"><a href="{{ url('/') }}"><span class="glyphicon glyphicon-search"></span> Business Search</a></li>
          <li id="my-business"><a href="{{ url('/business/my-business') }}" ><span class="glyphicon glyphicon-home"></span> My Business</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Edit my Profile</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  @yield('container')
<footer>
  <div class="row-fluid">
    <p class="text-center">&copy; 2015 : Reminisense Corp.</p>
  </div>
</footer>
@yield('scripts'){{-- ARA scripts at the bottom so html can load before js --}}
</body>
</html>