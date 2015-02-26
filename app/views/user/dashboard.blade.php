@extends('user.dashboard_master')

@section('subtitle')
    Dashboard
@stop

@section('scripts')
    {{ HTML::script('js/dashboard/dashboard.js') }}
    {{ HTML::script('js/dashboard/edit-business.js') }}
    {{ HTML::script('js/jquery.timepicker.min.js') }}
    {{ HTML::script('js/intlTelInput.js') }}
    {{ HTML::script('js/dashboard/jquery.validate.js') }}
    {{ HTML::script('js/dashboard/search-business.js') }}
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    {{ HTML::script('js/jquery.geocomplete.js') }}
@stop

@section('styles')
    {{ HTML::style('css/jquery.timepicker.min.css') }}
    {{ HTML::style('css/intlTelInput.css') }}
@stop

@section('content')
 <div class="row mt30">
    <div id="my_businesses" style="display: none;">
        @if(count($my_businesses) > 0)
            @foreach($my_businesses as $business)
                <div class="col-md-3" business_id="{{ $business->business_id }}">
                  <div class="boxed boxed-single edit-biz">
                    <div class="wrap">
                      <h3>{{ $business->name }}</h3>
                      <small>{{  $business->local_address }}</small>
                      <a href="" class="to-terminals"><span class="glyphicon glyphicon-share-alt"></span> Process</a>
                      @if($business->owner == 1)
                        <button data-toggle="modal" data-target="#editBusiness" data-business-id="{{ $business->business_id }}" class="btn btn-nobg edit-business-cog"><span class="glyphicon glyphicon-cog"></span></button>
                      @endif
                    </div>
                    <div class="biz-terminals">
                      <div class="clearfix">
                      @foreach($business->terminals as $terminal)
                        @if($terminal['assigned'] == 1)
                            <a href="{{url( '/processqueue/terminal/' . $terminal['terminal_id']) }}" target="_blank">
                        @else
                            <a href="#forbidden" class="not-active">
                        @endif
                          <span class="@if ($terminal['assigned'] == 1) {{ 'glyphicon glyphicon-ok' }} @else {{ 'glyphicon glyphicon-ban-circle' }} @endif "></span>
                          <small>{{ $terminal['name']; }}</small>
                        </a>
                      @endforeach
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
          <h5 class="mb30">@{{ searchLabel }}</h5>
        </div>
        @if(count($search_businesses) > 0)
        <div id="popular-businesses">
            @foreach($search_businesses as $business)
                <div class="col-md-3">
                  <div class="boxed boxed-single clickable">
                      <a href="{{ URL::to( '/broadcast/business/' . $business->business_id ) }}" target="_blank"> {{--RDH Links for Business' broadcast page--}}
                          <div class="wrap">
                              <h3>{{ $business->name }}</h3>
                              <small>{{ $business->local_address }}</small>
                          </div>
                      </a>
                  </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3" ng-repeat="business in businesses">
            <div class="boxed boxed-single clickable">
                <a href="/broadcast/business/@{{ business.business_id }}">
                    <div class="wrap">
                        <h3>@{{ business.business_name }}</h3>
                        <small>@{{ business.local_address }}</small>
                    </div>
                </a>
            </div>
        </div>
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
@stop

@section('modals')
    @include('modals.business.verify-user-modal')
    @include('modals.business.setup-business-modal')
    @include('modals.business.edit-business-modal')
@stop