<div class="col-md-12">
    <div class="boxed mb20">
        <div class="head head-wbtn">
            <h3>{{ $business_name }}</h3>
            <small>{{ $local_address }}</small>
           <a class="btn btn-half btn-blue" id="btn-message-business"  data-toggle="modal" data-target="#contact-business-modal"> <span class="glyphicon glyphicon-envelope"></span></a>
                       <a class="btn btn-half btn-blue" id="btn-bcast-details"> <span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="body broadcast body-gradient">
            @{{ numbers() }}
            <h4 class="text-center">Now Serving</h4>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank1 }}">
                        <p class="terminal">@{{ name1 }}</p>
                        @{{ box1 }}
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank2 }}">
                        <p class="terminal">@{{ name2 }}</p>
                        @{{ box2 }}
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank3 }}">
                        <p class="terminal">@{{ name3 }}</p>
                        @{{ box3 }}
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="numbers t@{{ rank4 }}">
                        <p class="terminal">@{{ name4 }}</p>
                        @{{ box4 }}
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
