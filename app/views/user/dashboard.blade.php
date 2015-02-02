@extends('user.dashboard_master')

@section('scripts')
    {{ HTML::script('js/dashboard/dashboard.js') }}
    {{ HTML::script('js/jquery.timepicker.min.js') }}
    {{ HTML::script('js/intlTelInput.js') }}
    {{ HTML::script('js/dashboard/jquery.validate.js') }}
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
@stop

@section('styles')
    {{ HTML::style('css/jquery.timepicker.min.css') }}
    {{ HTML::style('css/intlTelInput.css') }}
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

 <div class="row mt30">
    <div id="my_businesses" style="display: none;">

        @if(count($my_businesses) > 0)
            @foreach($my_businesses as $business)
                <div class="col-md-3">
                  <div class="boxed boxed-single edit-biz">
                    <div class="wrap">
                      <h3>{{ $business->name }}</h3>
                      <small>{{  $business->local_address }}</small>
                      <a href="" class="to-terminals"><span class="glyphicon glyphicon-share-alt"></span> Process</a>
                      <button data-toggle="modal" data-target="#editBusiness" class="btn btn-nobg"><span class="glyphicon glyphicon-cog"></span></button>
                    </div>
                    <div class="biz-terminals">
                      <div class="clearfix">
                        <a href="#">
                          <span class="glyphicon glyphicon-ok"></span>
                          <small>terminal 1</small>
                        </a>
                        <a href="#" class="not-active">
                          <span class="glyphicon glyphicon-ban-circle"></span>
                          <small>terminal 2</small>
                        </a>
                        <a href="#" class="not-active">
                          <span class="glyphicon glyphicon-ban-circle"></span>
                          <small>terminal 3</small>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        @endif

        <div class="col-md-3">
          <div class="boxed boxed-single to-modal" data-toggle="modal" id="add_business">
            <div class="wrap">
              <h3 class="orange"><span class="glyphicon glyphicon-plus"> </span>Add a business</h3>
            </div>
          </div>
        </div>
    </div>

    <div id="search_business" style="display: block;">
        <div class="col-md-12">
          <h5 class="mb30">POPULAR BUSINESSES</h5>
        </div>
        @if(count($search_businesses) > 0)
            @foreach($search_businesses as $business)
                <div class="col-md-3">
                  <div class="boxed boxed-single clickable">
                    <div class="wrap">
                      <h3>{{ $business->name }}</h3>
                      <small>{{ $business->local_address }}</small>
                    </div>
                  </div>
                </div>
            @endforeach
        @else
        <div class="col-md-3">
          <div class="boxed boxed-single clickable">
            <div class="wrap">
              <h3>No Available Businesses</h3>
              <small></small>
            </div>
          </div>
        </div>
        @endif
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
                <div class="col-md-6 has-warning">
                    <small>First Name</small>
                    <input type="text" class=" form-control" id="first_name" name="first_name" required />
                </div>
                <div class="col-md-6">
                    <small>Last Name</small>
                    <input type="text" class=" form-control" id="last_name" name="last_name" required />
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <small>Email</small>
                <input type="email" class=" form-control" id="email" name="email" required />
            </div>
            <div class="col-md-12">
                <small>Mobile</small>
                <input type="tel" class=" form-control" id="mobile" name="mobile" required/>
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <small>Location</small>
                <input type="text" class=" form-control" id="user_location" name="location" autocomplete="off" required=""/>
            </div>
          </div>
        </form>
        <div class="alert alert-danger" id="verifyError" style="display: none;"></div>
      </div>
      <div class="modal-footer">
        <button id="start_queuing" type="submit" class="btn btn-orange btn-lg">Start Queuing</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="setupBusiness" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="add_business_header">Setup your Business</h3>
      </div>
      <div class="modal-body">
        <form id="add_business_form" class="" action="business/setup-business" method="post">
            <input type="hidden" class="user_id" name="user_id" value="" />
          <div class="form-group row">
            <div class="col-md-12">
              <input type="text" class=" form-control" placeholder="Business Name" id="business_name" name="business_name">
            </div>
            <div class="col-md-12">
              <input type="text" class=" form-control" placeholder="Business Address" id="business_location" name="business_address">
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <input type="text" id="time_open" name="time_open" placeholder="Time Open" class="timepicker form-control" />
                    <span class="caret pull-right"></span>
                </div>
                <div class="col-md-6">
                    <input type="text" id="time_close" name="time_close" placeholder="Time Close" class="timepicker form-control" />
                    <span class="caret pull-right"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="btn-group">
                <select class="form-control" name="industry" id="industry">
                  <option value="">Select Industry</option>
                  <option value="Pharmaceutical">Pharmaceutical</option>
                  <option value="Education">Education</option>
                  <option value="Medical">Medical</option>
                  <option value="Customer Service">Customer Service</option>
                </select>
              </div>
            </div>
            <div class="col-md-12 mt10">
              <input type="text" class=" form-control" placeholder="Queue Number Limit" id="queue_limit" name="queue_limit">
            </div>
            <div class="col-md-12 mt10">
              <select class="form-control" name="num_terminals" id="num_terminals">
                <option value="">Select Number of Terminals</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
          </div>
        </form>
        <div class="alert alert-danger" id="setupError" style="display: none;"></div>
      </div>
      <div class="modal-footer">
        <a id="skip_step_link" class="orange" style="margin-right: 140px;" href="/">Setup Business Later</a>
        <button id="submit_business" type="button" class="btn btn-orange btn-lg">SUBMIT</button>
      </div>
    </div>
  </div>
</div>
<!--eo modal-->
@stop