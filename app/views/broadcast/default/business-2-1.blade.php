@include('broadcast.default.business-ads-master')

<div class="ads-area fifty fifty-a abs">
  <div class="top">
    <a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
  </div>
  <div class="vid-container">
    {{ $ad_src }}
  </div>
</div>

<div class="numbers-area {{ $num_class }} abs">
    <div class="boxed one">
        <h3 class="abs">NOW SERVING</h3>
        <div class="row-1">
            <div class="col-1">
                <div class="numbers t@{{ rank1 }}">
                    <p class="terminal">@{{ name1 }}</p>
                    <p class="callnum">@{{ box1 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>