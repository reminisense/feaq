@include('broadcast.default.business-ads-master')

<input type="hidden" value="{{ $groupsToShow[0] }}" ng-model="box1" id="box1">
<input type="hidden" value="{{ $groupsToShow[1] }}" ng-model="box2" id="box2">
<input type="hidden" value="{{ $groupsToShow[2] }}" ng-model="box3" id="box3">
<input type="hidden" value="{{ $groupsToShow[3] }}" ng-model="box4" id="box4">
<input type="hidden" value="{{ $groupsToShow[4] }}" ng-model="box5" id="box5">
<input type="hidden" value="{{ $groupsToShow[5] }}" ng-model="box6" id="box6">
<input type="hidden" value="{{ $groupsToShow[6] }}" ng-model="box7" id="box7">
<input type="hidden" value="{{ $groupsToShow[7] }}" ng-model="box8" id="box8">
<input type="hidden" value="{{ $groupsToShow[8] }}" ng-model="box9" id="box9">
<input type="hidden" value="{{ $groupsToShow[9] }}" ng-model="box10" id="box10">
<input type="hidden" value="{{ $groupsToShow[10] }}" ng-model="box11" id="box11">
<input type="hidden" value="{{ $groupsToShow[11] }}" ng-model="box12" id="box12">
<input type="hidden" value="{{ $groupsToShow[12] }}" ng-model="box13" id="box13">
<input type="hidden" value="{{ $groupsToShow[13] }}" ng-model="box14" id="box14">
<input type="hidden" value="{{ $groupsToShow[14] }}" ng-model="box15" id="box15">

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed business-spec" id="broadcast-spec">
    <div class="title">
      <h3><span id="callednums-title">{{ $business_name }}</span></h3>
    </div>
    <div class="row services-container eight-rows">
      <div class="col-md-6 service-box @{{ color1 }}">
        <div class="row title">@{{ service1 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current1 }}
            <p class="terminal">@{{ terminal1 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called1 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color2 }}">
        <div class="row title">@{{ service2 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current2 }}
            <p class="terminal">@{{ terminal2 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called2 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color3 }}">
        <div class="row title">@{{ service3 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current3 }}
            <p class="terminal">@{{ terminal3 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called3 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color4 }}">
        <div class="row title">@{{ service4 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current4 }}
            <p class="terminal">@{{ terminal4 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called4 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color5 }}">
        <div class="row title">@{{ service5 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current5 }}
            <p class="terminal">@{{ terminal5 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called5 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color6 }}">
        <div class="row title">@{{ service6 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current6 }}
            <p class="terminal">@{{ terminal6 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called6 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color7 }}">
        <div class="row title">@{{ service7 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current7 }}
            <p class="terminal">@{{ terminal7 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called7 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color8 }}">
        <div class="row title">@{{ service8 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current8 }}
            <p class="terminal">@{{ terminal8 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called8 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color9 }}">
        <div class="row title">@{{ service9 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current9 }}
            <p class="terminal">@{{ terminal9 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called9 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color10 }}">
        <div class="row title">@{{ service10 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current10 }}
            <p class="terminal">@{{ terminal10 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called10 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color11 }}">
        <div class="row title">@{{ service11 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current11 }}
            <p class="terminal">@{{ terminal11 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called11 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color12 }}">
        <div class="row title">@{{ service12 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current12 }}
            <p class="terminal">@{{ terminal12 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called12 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color13 }}">
        <div class="row title">@{{ service13 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current13 }}
            <p class="terminal">@{{ terminal13 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called13 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color14 }}">
        <div class="row title">@{{ service14 }}</div>
        <div class="row number-list">
          <div class="col-md-8 current dark-orange blink-num">@{{ current14 }}
            <p class="terminal">@{{ terminal14 }}</p>
          </div>
          <div class="col-md-4">
            <p>@{{ called14 }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-12 service-box @{{ color15 }}">
        <div class="row title">@{{ service15 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current15 }}
            <p class="terminal">@{{ terminal15 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called15 }}</marquee>
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