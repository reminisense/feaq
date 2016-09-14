<div class="numbers-area" style="width: 100% !important;">
    <div class="boxed one">
        <h3 class="abs">{{ $business_name }}</h3>
        <div class="row-1">
            <div class="col-2">
                <div class="numbers t@{{ rank1 }} @{{ color1 }} blink-num">
                    <p class="service">@{{ service1 }}</p>
                    <p class="terminal">@{{ name1 }}</p>
                    <p class="callnum">@{{ box1 }}</p>
                    <p class="terminal">@{{ user1 }}</p>
                </div>
            </div>
            <div class="col-2">
              <div class="numbers t4">
                <div class="clearfix qrcode">
                    <div class="clearfix text-center">
                      <img class=" qrcode" src="https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120">
                      <br> <h4 class="orange">Monitor via your phone.</h4>
                      <p>Just scan this QR Code</p><br>
                      <p>or visit this url:</p>
                      <h4>{{ $_SERVER['HTTP_HOST'] }}/<span>{{ $custom_url }}</span></h4>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>