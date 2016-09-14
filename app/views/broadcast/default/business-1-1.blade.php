@include('broadcast.default.business-ads-master')

<div class="numbers-area {{ $num_class }} abs">
  <div class="boxed one">
    <h3 class="abs">{{ $business_name }}</h3>
    <div class="row-1">
      <div class="col-1">
        <div class="numbers t@{{ rank1 }} @{{ color1 }} blink-num">
          <p class="service">@{{ service1 }}</p>
          <p class="terminal">@{{ name1 }}</p>
          <p class="callnum">@{{ box1 }}</p>
          <p class="terminal">@{{ user1 }}</p>
        </div>
      </div>
    </div>
  </div>
</div>