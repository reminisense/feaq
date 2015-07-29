<div class="col-md-12">
    <div class="boxed mb20">
        <div class="head head-wbtn">
            <h3>{{ $business_name }}</h3>
            <small>{{ $local_address }}</small>
            @if (Auth::check())
                <a class="btn btn-half btn-blue" id="btn-message-business" data-toggle="modal" data-target="#contact-business-modal"> <span class="glyphicon glyphicon-envelope"></span></a>
            @else
                <a class="btn btn-half btn-warning" id="btn-message-business"> <span class="glyphicon glyphicon-envelope"></span> Please login to send this business a message.</a>
            @endif
            <a class="btn btn-half btn-blue" id="btn-bcast-details"> <span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="body broadcast body-gradient">
            @{{ numbers() }}
            <h4 class="text-center">Now Serving</h4>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="numbers t@{{ rank1 }} spaceht">
                        <p class="terminal">@{{ name1 }}</p>
                        @{{ box1 }}
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
