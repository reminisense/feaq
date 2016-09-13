@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed three">
    <h3 class="abs">{{ $business_name }}</h3>
    <div class="row-3">
      <div class="col-1">
        <div class="numbers t@{{ rank1 }} @{{ color1 }}">
          <p class="service blink-num">@{{ service1 }}</p>
          <p class="terminal blink-num">@{{ name1 }}</p>
          <p class="callnum blink-num">@{{ box1 }}</p>
          <p class="terminal blink-num">@{{ user1 }}</p>
        </div>
      </div>
      <div class="col-1">
        <div class="numbers t@{{ rank2 }} @{{ color2 }}">
          <p class="service">@{{ service2 }}</p>
          <p class="terminal">@{{ name2 }}</p>
          <p class="callnum">@{{ box2 }}</p>
          <p class="terminal">@{{ user2 }}</p>
        </div>
      </div>
      <div class="col-1">
        <div class="numbers t@{{ rank3 }} @{{ color3 }}">
          <p class="service">@{{ service3 }}</p>
          <p class="terminal">@{{ name3 }}</p>
          <p class="callnum">@{{ box3 }}</p>
          <p class="terminal">@{{ user3 }}</p>
        </div>
      </div>
    </div>
  </div>
</div>