<div class="qnow-title">
    <h3><span id="now-serving-title">QUEUE NOW</span></h3>
</div>
<div class="qnow-nums">
    <div class="checkin-carousel" id="business-queue-now">
        <div id="checkin-numbers-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div ng-class="{'item active': $index == 0, 'item': $index > 0}" ng-repeat="queue_nums in queue_now_services">
                    <div class="carousel-caption">
                        <p class="numbers">@{{ queue_nums[0] }}</p>
                        <p class="numbers">@{{ queue_nums[1] }}</p>
                        <p class="numbers">@{{ queue_nums[2] }}</p>
                        <p class="numbers">@{{ queue_nums[3] }}</p>
                        <p class="numbers">@{{ queue_nums[4] }}</p>
                        <p class="numbers">@{{ queue_nums[5] }}</p>
                        <p class="numbers">@{{ queue_nums[6] }}</p>
                        <p class="numbers">@{{ queue_nums[7] }}</p>
                        <p class="numbers">@{{ queue_nums[8] }}</p>
                        <p class="numbers">@{{ queue_nums[9] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-nums" id="service-queue-now" style="display: none;">
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[0] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[1] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[2] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[3] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[4] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[5] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[6] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[7] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[8] }}</div>
        <div class="number" ng-repeat="queue_now_nums in queue_now_services">@{{ queue_now_nums[9] }}</div>
    </div>
</div>