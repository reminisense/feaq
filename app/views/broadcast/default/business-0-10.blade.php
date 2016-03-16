<div class="numbers-area">
        <div class="boxed ten">
          <h3 class="abs">NOW SERVING</h3>
          <div class="row-4">
            <div class="col-3">
                <div class="numbers t@{{ rank1 }} @{{ color1 }}">
                    <p class="service">@{{ service1 }}</p>
                    <p class="terminal">@{{ name1 }}</p>
                    <p class="callnum">@{{ box1 }}</p>
                    <p class="terminal">@{{ user1 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank2 }} @{{ color2 }}">
                    <p class="service">@{{ service2 }}</p>
                    <p class="terminal">@{{ name2 }}</p>
                    <p class="callnum">@{{ box2 }}</p>
                    <p class="terminal">@{{ user2 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank3 }} @{{ color3 }}">
                    <p class="service">@{{ service3 }}</p>
                    <p class="terminal">@{{ name3 }}</p>
                    <p class="callnum">@{{ box3 }}</p>
                    <p class="terminal">@{{ user3 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank4 }} @{{ color4 }}">
                    <p class="service">@{{ service4 }}</p>
                    <p class="terminal">@{{ name4 }}</p>
                    <p class="callnum">@{{ box4 }}</p>
                    <p class="terminal">@{{ user4 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank5 }} @{{ color5 }}">
                    <p class="service">@{{ service5 }}</p>
                    <p class="terminal">@{{ name5 }}</p>
                    <p class="callnum">@{{ box5 }}</p>
                    <p class="terminal">@{{ user5 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank6 }} @{{ color6 }}">
                    <p class="service">@{{ service6 }}</p>
                    <p class="terminal">@{{ name6 }}</p>
                    <p class="callnum">@{{ box6 }}</p>
                    <p class="terminal">@{{ user6 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank7 }} @{{ color7 }}">
                    <p class="service">@{{ service7 }}</p>
                    <p class="terminal">@{{ name7 }}</p>
                    <p class="callnum">@{{ box7 }}</p>
                    <p class="terminal">@{{ user7 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank8 }} @{{ color8 }}">
                    <p class="service">@{{ service8 }}</p>
                    <p class="terminal">@{{ name8 }}</p>
                    <p class="callnum">@{{ box8 }}</p>
                    <p class="terminal">@{{ user8 }}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="numbers t@{{ rank9 }} @{{ color9 }}">
                    <p class="service">@{{ service9 }}</p>
                    <p class="terminal">@{{ name9 }}</p>
                    <p class="callnum">@{{ box9 }}</p>
                    <p class="terminal">@{{ user9 }}</p>
                </div>
            </div>
            <div class="col-2">
                <div class="numbers t@{{ rank10 }} @{{ color10 }}">
                    <p class="service">@{{ service10 }}</p>
                    <p class="terminal">@{{ name10 }}</p>
                    <p class="callnum">@{{ box10 }}</p>
                    <p class="terminal">@{{ user10 }}</p>
                </div>
            </div>
            <div class="col-2">
              <div class="numbers t4">
                <div class="clearfix qrcode">
                  <div class="col-md-5">
                    <div class="text-center">
                      <img class="qrcode" src="https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120">
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