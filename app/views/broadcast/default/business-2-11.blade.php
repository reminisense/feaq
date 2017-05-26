@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed business-spec" id="broadcast-spec">
    <div class="title">
      <h3><span id="callednums-title">{{ $business_name }}</span></h3>
    </div>
    <div class="row services-container six-rows">
      <div class="col-md-6 service-box @{{ color1 }}">
        <div class="row title">@{{ service1 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current1 }}
            <p class="terminal">@{{ terminal1 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called1 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color2 }}">
        <div class="row title">@{{ service2 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current2 }}
            <p class="terminal">@{{ terminal2 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called2 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color3 }}">
        <div class="row title">@{{ service3 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current3 }}
            <p class="terminal">@{{ terminal3 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called3 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color4 }}">
        <div class="row title">@{{ service4 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current4 }}
            <p class="terminal">@{{ terminal4 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called4 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color5 }}">
        <div class="row title">@{{ service5 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current5 }}
            <p class="terminal">@{{ terminal5 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called5 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color6 }}">
        <div class="row title">@{{ service6 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current6 }}
            <p class="terminal">@{{ terminal6 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called6 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color7 }}">
        <div class="row title">@{{ service7 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current7 }}
            <p class="terminal">@{{ terminal7 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called7 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color8 }}">
        <div class="row title">@{{ service8 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current8 }}
            <p class="terminal">@{{ terminal8 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called8 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color9 }}">
        <div class="row title">@{{ service9 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current9 }}
            <p class="terminal">@{{ terminal9 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called9 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-6 service-box @{{ color10 }}">
        <div class="row title">@{{ service10 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current10 }}
            <p class="terminal">@{{ terminal10 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called10 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-12 service-box @{{ color11 }}">
        <div class="row title">@{{ service11 }}</div>
        <div class="row number-list">
          <div class="col-md-6 current dark-orange blink-num">@{{ current11 }}
            <p class="terminal">@{{ terminal11 }}</p>
          </div>
          <div class="col-md-6">
            <marquee>@{{ called11 }}</marquee>
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