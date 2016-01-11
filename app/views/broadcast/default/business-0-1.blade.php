<div class="numbers-area" style="width: 100% !important;">
    <div class="boxed one">
        <h3 class="abs">NOW SERVING</h3>
        <div class="row-1">
            <div class="col-2">
                <div class="numbers t@{{ rank1 }}">
                    <p class="service">@{{ service1 }}</p>
                    <p class="terminal">@{{ name1 }}</p>
                    <p class="callnum">@{{ box1 }}</p>
                </div>
            </div>
            <div class="col-2">
              <div class="numbers t4">
                <div class="clearfix qrcode">
                  <div class="col-md-5">
                    <div class="text-center">
                      <img width="75%" class="qrcode" src="https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h4 class="orange">Monitor via your phone.</h4> <p>Just scan this QR Code</p>
                  </div>
                    <div class="col-md-12">
                        <div id="cust-url">
                            {{ $_SERVER['HTTP_HOST'] }}/<span>{{ $custom_url }}</span>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>