@include('broadcast.default.business-ads-master')

<div class="col-md-6">
    <div class="boxed mb20">
        <div class="head">
            <h4 class="text-center">Now Serving</h4>
        </div>
        <div class="body broadcast" style="height: 83.5vh;">

            <div class="row-fluid ads-onenum">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="numbers t@{{ rank1 }}">
                        <p class="terminal">@{{ name1 }}</p>
                        <h1>@{{ box1 }}</h1>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="text-center qrwrap">
                    <p class="orange nomg" style="padding-top: 30px;">On the go?</p>
                    <p class="mb40" style="font-size: 22px;">Scan this QR Code on your mobile phone</p>
                        <div class="text-center">
                            <img class="qrcode" src='https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=120x120' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>