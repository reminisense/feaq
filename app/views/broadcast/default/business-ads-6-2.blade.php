<div class="col-md-9">

	<div class="top">
  		<a class="" href="#"><img src="/images/featherq-home-logo.png"></a>
	</div>
	<div class="vid-container">
  		<iframe width="100%" height="100%" src="https://www.youtube.com/embed/yWGcemRDn4E" frameborder="0" allowfullscreen></iframe>
  	</div>

</div>

<div class="col-md-3">
  <div class="boxed mb20 itv4">
    <div class="head">
      <h4 class="text-center">Now Serving</h4>
    </div>
    <div class="body broadcast itv4">

        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="numbers t@{{ rank1 }}">
            <p class="terminal">@{{ name1 }}</p>
            <p class="callnum">@{{ box1 }}</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="numbers t@{{ rank2 }}">
            <p class="terminal">@{{ name2 }}</p>
            <p class="callnum">@{{ box2 }}</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="numbers t@{{ rank3 }}">
            <p class="terminal">@{{ name3 }}</p>
            <p class="callnum">@{{ box3 }}</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="numbers t@{{ rank4 }}">
            <p class="terminal">@{{ name4 }}</p>
            <p class="callnum">@{{ box4 }}</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="numbers t@{{ rank5 }}">
            <p class="terminal">@{{ name5 }}</p>
            <p class="callnum">@{{ box5 }}</p>
          </div>
        </div>
        <div class="col-md-12 col-sm-6 col-xs-12 qrwrap">
          <div class="col-md-6 col-sm-6 text-center" style="margin-top: 40px;">
            <h1 class="orange nomg">On the go?</h1>
            <p class="nomg">Scan this QR Code on your mobile phone</p>
          </div>
          <div class="col-md-6 col-sm-6 text-center">
            <img class="qrcode" src='https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120' />
          </div>
        </div>
    </div>
  </div>
</div>