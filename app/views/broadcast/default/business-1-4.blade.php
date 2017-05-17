@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed business-spec" id="broadcast-spec">
    <div class="title">
      <h3><span id="callednums-title">{{ $business_name }}</span></h3>
    </div>
    <div class="parent-num">
      <div class="numbers t@{{ rank1 }} @{{ color1 }} ">
        <div class="wrap-nums">
          <p class="callnum ">@{{ box1 }}</p>
          <p class="service ">@{{ service1 }}</p>
          <p class="terminal ">@{{ name1 }}</p>
          <p class="terminal ">@{{ user1 }}</p>
          <!-- below is the same color as parent div -->
          <div class="dark-orange blink-num"></div>
        </div>
      </div>
    </div>
    <div class="child-nums four-nums">
      <div class="wrap-nums">
        <div class="number @{{ color2 }}">
          <p>@{{ box2 }}</p>
          <p class="service ">@{{ service2 }}</p>
          <p class="terminal ">@{{ name2 }}</p>
          <p class="terminal ">@{{ user2 }}</p>
        </div>
        <div class="number @{{ color3 }}">
          <p>@{{ box3 }}</p>
          <p class="service ">@{{ service3 }}</p>
          <p class="terminal ">@{{ name3 }}</p>
          <p class="terminal ">@{{ user3 }}</p>
        </div>
        <div class="number @{{ color4 }}">
          <p>@{{ box4 }}</p>
          <p class="service ">@{{ service4 }}</p>
          <p class="terminal ">@{{ name4 }}</p>
          <p class="terminal ">@{{ user4 }}</p>
        </div>
      </div>
    </div>
  </div>
</div>