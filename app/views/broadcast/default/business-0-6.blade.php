<div class="numbers-area">
        <div class="boxed six">
          <h3 class="abs">NOW SERVING</h3>
          <div class="row-2">
            <div class="col-3">
                <div class="numbers t@{{ rank1 }}">
                    <p class="service">@{{ service1 }}</p>
                    <p class="terminal">@{{ name1 }}</p>
                    <p class="callnum">@{{ box1 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank2 }}">
                    <p class="service">@{{ service2 }}</p>
                    <p class="terminal">@{{ name2 }}</p>
                    <p class="callnum">@{{ box2 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank3 }}">
                    <p class="service">@{{ service3 }}</p>
                    <p class="terminal">@{{ name3 }}</p>
                    <p class="callnum">@{{ box3 }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="numbers t@{{ rank4 }}">
                    <p class="service">@{{ service4 }}</p>
                    <p class="terminal">@{{ name4 }}</p>
                    <p class="callnum">@{{ box4 }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="numbers t@{{ rank5 }}">
                    <p class="service">@{{ service5 }}</p>
                    <p class="terminal">@{{ name5 }}</p>
                    <p class="callnum">@{{ box5 }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="numbers t@{{ rank6 }}">
                    <p class="service">@{{ service6 }}</p>
                    <p class="terminal">@{{ name6 }}</p>
                    <p class="callnum">@{{ box6 }}</p>
                </div>
            </div>
            <div class="col-4">
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