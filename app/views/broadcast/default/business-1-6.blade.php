@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed business-spec" id="broadcast-spec">
    <div class="title">
      <h3><span id="callednums-title">{{ $business_name }}</span></h3>
    </div>
    <div class="parent-num">
      <div class="numbers t@{{ rank1 }} @{{ color1 }} ">
        <div class="wrap-nums">
          <p class="callnum ng-binding">@{{ box1 }}</p>
          <p class="service ng-binding">@{{ service1 }}</p>
          <p class="terminal ng-binding">@{{ name1 }}</p>
          <p class="terminal ng-binding">@{{ user1 }}</p>
          <!-- below is the same color as parent div -->
          <div class="dark-orange blink-num"></div>
        </div>
      </div>
    </div>
    <div class="child-nums six-nums">
      <div class="wrap-nums">
        <div class="number @{{ color2 }}">
          <p>@{{ box2 }}</p>
          <p class="service ng-binding">@{{ service2 }}</p>
          <p class="terminal ng-binding">@{{ name2 }}</p>
          <p class="terminal ng-binding">@{{ user2 }}</p>
        </div>
        <div class="number @{{ color3 }}">
          <p>@{{ box3 }}</p>
          <p class="service ng-binding">@{{ service3 }}</p>
          <p class="terminal ng-binding">@{{ name3 }}</p>
          <p class="terminal ng-binding">@{{ user3 }}</p>
        </div>
        <div class="number @{{ color4 }}">
          <p>@{{ box4 }}</p>
          <p class="service ng-binding">@{{ service4 }}</p>
          <p class="terminal ng-binding">@{{ name4 }}</p>
          <p class="terminal ng-binding">@{{ user4 }}</p>
        </div>
        <div class="number @{{ color5 }}">
          <p>@{{ box5 }}</p>
          <p class="service ng-binding">@{{ service5 }}</p>
          <p class="terminal ng-binding">@{{ name5 }}</p>
          <p class="terminal ng-binding">@{{ user5 }}</p>
        </div>
        <div class="number @{{ color6 }}">
          <p>@{{ box6 }}</p>
          <p class="service ng-binding">@{{ service6 }}</p>
          <p class="terminal ng-binding">@{{ name6 }}</p>
          <p class="terminal ng-binding">@{{ user6 }}</p>
        </div>
      </div>
    </div>
    @include('broadcast.default.queue-now')
  </div>
</div>