<div class="col-md-12">
    <div class="boxed mb20">
        <div class="head head-wbtn">
            <h3>{{ $business_name }}</h3>
            <small>{{ $local_address }}</small>
            <a class="btn btn-half btn-blue" id="btn-bcast-details"> <span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="body broadcast body-gradient">
            @{{ numbers() }}
            <h4 class="text-center">Now Serving</h4>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank1 }} @{{ color1 }}">
                        <p class="terminal">@{{ service1 }}</p>
                        <p class="terminal">@{{ name1 }}</p>
                        <h3>@{{ box1 }}</h3>
                        <p class="terminal">@{{ user1 }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank2 }} @{{ color2 }}">
                        <p class="terminal">@{{ service2 }}</p>
                        <p class="terminal">@{{ name2 }}</p>
                        <h3>@{{ box2 }}</h3>
                        <p class="terminal">@{{ user2 }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank3 }} @{{ color3 }}">
                        <p class="terminal">@{{ service3 }}</p>
                        <p class="terminal">@{{ name3 }}</p>
                        <h3>@{{ box3 }}</h3>
                        <p class="terminal">@{{ user3 }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank4 }} @{{ color4 }}">
                        <p class="terminal">@{{ service4 }}</p>
                        <p class="terminal">@{{ name4 }}</p>
                        <h3>@{{ box4 }}</h3>
                        <p class="terminal">@{{ user4 }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank5 }} @{{ color5 }}">
                        <p class="terminal">@{{ service5 }}</p>
                        <p class="terminal">@{{ name5 }}</p>
                        <h3>@{{ box5 }}</h3>
                        <p class="terminal">@{{ user5 }}</p>
                    </div>
                </div>
            </div>
            <div class="bcast-details">
                <div class="wrap">
                    <table class="table">
                        <tr>
                            <td>Open Time</td>
                            <td>{{ $open_time }}</td>
                        </tr>
                        <tr>
                            <td>Closing Time</td>
                            <td>{{ $close_time }}</td>
                        </tr>
                        <tr>
                            <td>Maximum # of queue</td>
                            <td>{{ $lines_in_queue }}</td>
                        </tr>
                        <tr>
                            <td>Estimate serving per #</td>
                            <td>{{ $estimate_serving_time }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
