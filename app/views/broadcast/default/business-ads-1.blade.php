@include('broadcast.default.ads-master')

<div class="col-md-6">
    <div class="boxed mb20">
        <div class="head">
            <h4 class="text-center">Now Serving</h4>
        </div>
        <div class="body broadcast">

            <div class="row-fluid ads-onenum">
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="text-center qrwrap">
                        <p class="orange nomg">On the go?</p>
                        <p class="nomg">Scan this QR Code on your mobile phone</p>
                        <div class="text-center">
                            <img class="qrcode" src='https://api.qrserver.com/v1/create-qr-code/?data={{ URL::to('/broadcast/business/' . $business_id) }}&size=150x150' />
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 col-xs-12">
                    <div class="numbers t@{{ rank1 }}">
                        <p class="terminal">@{{ name1 }}</p>
                        <h1>@{{ box1 }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>