@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed business-spec" id="broadcast-spec">
    <div class="title">
      <h3><span id="callednums-title">{{ $business_name }}</span></h3>
    </div>
    <div class="row services-container two-rows">
      <div class="col-md-12 service-box @{{ color1 }}">
        <div class="row title">@{{ service1 }}</div>
        <div class="row number-list">
          <div class="col-md-12 current dark-orange blink-num">@{{ current1 }}
            <p class="terminal"
               style="margin-top: -10px; font-size: 30px;">@{{ terminal1 }}</p>
          </div>
          <div class="col-md-12">
            <marquee>@{{ called1 }}</marquee>
          </div>
        </div>
      </div>
      <div class="col-md-12 service-box @{{ color2 }}">
        <div class="row title">@{{ service2 }}</div>
        <div class="row number-list">
          <div class="col-md-12 current dark-orange blink-num">@{{ current2 }}
            <p class="terminal" style="margin-top: -10px; font-size: 30px;">@{{ terminal2 }}</p>
          </div>
          <div class="col-md-12">
            <marquee>@{{ called2 }}</marquee>
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
        <h4 class="modal-title">@{{ now_service }}</h4>
      </div>
      <div class="modal-body @{{ now_color }}">
        <div class="modal-number">
          @{{ now_number }}
          <p class="modal-terminal">
            @{{ now_terminal }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>