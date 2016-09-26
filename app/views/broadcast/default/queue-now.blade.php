<div class="qnow-title">
    <h3><span id="now-serving-title">QUEUE NOW</span></h3>
</div>
<div class="qnow-nums">
    <div class="checkin-carousel">
        <div id="checkin-numbers-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div ng-class="{'item active': $index == 0, 'item': $index > 0,}" ng-repeat="queue_nums in queue_now_services">
                    <div class="carousel-caption">
                        <p class="numbers">@{{ queue_nums }}</p>
                        <p class="numbers" ng-repeat="queue_num in queue_nums">@{{ queue_num }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>