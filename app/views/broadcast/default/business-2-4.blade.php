@include('broadcast.default.business-ads-master')

<input type="hidden" value="{{ $groupsToShow[0] }}" ng-model="box1" id="box1">
<input type="hidden" value="{{ $groupsToShow[1] }}" ng-model="box2" id="box2">
<input type="hidden" value="{{ $groupsToShow[2] }}" ng-model="box3" id="box3">
<input type="hidden" value="{{ $groupsToShow[3] }}" ng-model="box3" id="box4">

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed business-spec" id="broadcast-spec">
    <div class="title">
      <h3><span id="callednums-title">{{ $business_name }}</span></h3>
    </div>
    <div class="row services-container two-rows">
      <div class="col-md-6 service-box @{{ color1 }}">
        <div class="row title">@{{ service1 }}</div>
        <div class="row number-list">
          <div class="col-md-12 current dark-orange blink-num">@{{ current1 }}
            <p class="terminal">@{{ terminal1 }}</p>
          </div>
          <div class="col-md-12">
            <p>@{{ called1 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color2 }}">
        <div class="row title">@{{ service2 }}</div>
        <div class="row number-list">
          <div class="col-md-12 current dark-orange blink-num">@{{ current2 }}
            <p class="terminal">@{{ terminal2 }}</p>
          </div>
          <div class="col-md-12">
            <p>@{{ called2 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color3 }}">
        <div class="row title">@{{ service3 }}</div>
        <div class="row number-list">
          <div class="col-md-12 current dark-orange blink-num">@{{ current3 }}
            <p class="terminal">@{{ terminal3 }}</p>
          </div>
          <div class="col-md-12">
            <p>@{{ called3 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color4 }}">
        <div class="row title">@{{ service4 }}</div>
        <div class="row number-list">
          <div class="col-md-12 current dark-orange blink-num">@{{ current4 }}
            <p class="terminal">@{{ terminal4 }}</p>
          </div>
          <div class="col-md-12">
            <p>@{{ called4 }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="currently-called-number" tabindex="-1" role="dialog"
     aria-labelledby="currentlyCalledNumber">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@{{ now_group }}</h4>
      </div>
      <div class="modal-body @{{ now_color }}">
        <div class="modal-number">
          @{{ now_number }}
          <p class="modal-service">
            @{{ now_service }}
          </p>
          <p class="modal-terminal">
            @{{ now_terminal }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>