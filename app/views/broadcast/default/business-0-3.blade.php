<div class="numbers-area">
    <div class="boxed three">
        <h3 class="abs">NOW SERVING</h3>
        <div class="row-2">
            <div class="col-2">
                <div class="numbers t@{{ rank1 }} @{{ color1 }}">
                    <p class="service">@{{ service1 }}</p>
                    <p class="terminal">@{{ name1 }}</p>
                    <p class="callnum">@{{ box1 }}</p>
                    <p class="terminal">@{{ user1 }}</p>
                </div>
            </div>
            <div class="col-2">
                <div class="numbers t@{{ rank2 }} @{{ color2 }}">
                    <p class="service">@{{ service2 }}</p>
                    <p class="terminal">@{{ name2 }}</p>
                    <p class="callnum">@{{ box2 }}</p>
                    <p class="terminal">@{{ user2 }}</p>
                </div>
            </div>
            <div class="col-2">
                <div class="numbers t@{{ rank3 }} @{{ color3 }}">
                    <p class="service">@{{ service3 }}</p>
                    <p class="terminal">@{{ name3 }}</p>
                    <p class="callnum">@{{ box3 }}</p>
                    <p class="terminal">@{{ user3 }}</p>
                </div>
            </div>
            <div class="col-2">
              <div class="numbers t4">
                <div class="clearfix qrcode">
                    <div class="clearfix text-center">
                      <img class=" qrcode" src="https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120">
                      <h4 class="orange">Monitor via your phone.</h4>
                      <p>Just scan this QR Code</p>
                      <p>or visit this url:</p>
                      <h4>{{ $_SERVER['HTTP_HOST'] }}/<span>{{ $custom_url }}</span></h4>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>