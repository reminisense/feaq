@extends('user.dashboard_master')

@section('scripts')
    {{ HTML::script('js/dashboard/dashboard.js') }}
    {{ HTML::script('js/jquery.timepicker.min.js') }}
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
@stop

@section('styles')
    {{ HTML::style('css/jquery.timepicker.min.css') }}
@stop

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

@section('modals')
<!-- modal -->
<div class="modal fade" id="verifyUser" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Please confirm your data</h3>
      </div>
      <div class="modal-body">
        <form id="verification_form" action="/user/verify-user" method="post">
          <input type="hidden" class="user_id" name="user_id" value="" />
          <div class="form-group row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <small>First Name</small>
                    <input type="text" class=" form-control" id="first_name" name="first_name" value="" />
                </div>
                <div class="col-md-6">
                    <small>Last Name</small>
                    <input type="text" class=" form-control" id="last_name" name="last_name" value="" />
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <small>Email</small>
                <input type="text" class=" form-control" id="email" name="email" value="" />
            </div>
            <div class="col-md-12">
                <small>Mobile</small>
                <input type="text" class=" form-control" id="mobile" name="mobile" value="" required=""/>
            </div>
            <div class="col-md-12">
                <small>Location</small>
                <input type="text" class=" form-control" id="location" name="location" autocomplete="off" value="" required=""/>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="start_queuing" type="submit" class="btn btn-orange btn-lg">Start Queuing</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addBusiness" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Setup your Business</h3>
      </div>
      <div class="modal-body">
        <form id="add_business_form" class="" action="business/setup-business" method="post">
            <input type="hidden" class="user_id" name="user_id" value="" />
          <div class="form-group row">
            <div class="col-md-12">
              <input type="text" class=" form-control" placeholder="Business Name" name="business_name">
            </div>
            <div class="col-md-12">
              <input type="text" class=" form-control" placeholder="Business Address" name="business_address">
            </div>
            <div class="col-md-12">
              <input type="text" class=" form-control" placeholder="Email" name="email">
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <input type="text" name="time_open" placeholder="Time Open" class="timepicker form-control" />
                    <span class="caret pull-right"></span>
                </div>
                <div class="col-md-6">
                    <input type="text" name="time_close" placeholder="Time Close" class="timepicker form-control" />
                    <span class="caret pull-right"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="btn-group">
                <select class="form-control" name="industry">
                  <option value="Pharmaceutical">Pharmaceutical</option>
                  <option value="Education">Education</option>
                  <option value="Medical">Medical</option>
                  <option value="Customer Service">Customer Service</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 mt10">
              <input type="text" class=" form-control" placeholder="Queue Number Limit" name="queue_limit">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="submit_business" type="button" class="btn btn-orange btn-lg">SUBMIT</button>
      </div>
    </div>
  </div>
</div>
<!--eo modal-->
@stop