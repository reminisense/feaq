@extends('user.dashboard_master')

@section('nav-bar')
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="images/featherq-home-logo.png"></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello Rodeldo! <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
@stop

@section('content')
<div class="container main-wrap">
  <div class="row filters">
    <div class="col-md-5 col-md-offset-1">
      <div class="filterwrap">
        <span>FILTER:</span>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Location
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
              <li><a href="#">Dropdown link</a></li>
              <li><a href="#">Dropdown link</a></li>
            </ul>
          </div>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Industry Type
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 2</a></li>
            </ul>
          </div>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              Time Open
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 3</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="searchblock">
        <form>
          <input type="text" placeholder="Search a Business">
          <button type="button" class="btn btn-orange btn-md">SEARCH</button>
        </form>
      </div>
    </div>
  </div>

   <div class="row">
    <div class="col-md-12">
      <h5 class="mb30">POPULAR BUSINESSES</h5>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="boxed boxed-single clickable">
        <div class="wrap">
          <h3>Kublai Khan Ayala</h3>
          <small>Parkmall, North Reclamation Area</small>
        </div>
      </div>
    </div>
  </div>
</div>
@stop