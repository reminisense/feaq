<div class="clearfix header">
    <h5 class="mb20">BUSINESS ANALYTICS</h5>
    <form class="clearfix" ng-submit="getBusinessAnalytics(startdate, enddate)">
        <div class="col-md-2">
            <input type="text" id="start-date" name="start-date" class="form-control datepicker" ng-model="startdate"/><b>-</b>
        </div>
        <div class="col-md-2">
            <input type="text" id="end-date" name="end-date" class="form-control datepicker" ng-model="enddate"/>
        </div>
        <div class="col-md-8">
            <button class="btn btn-lg btn-primary" type="submit" ng-disabled="startdate > enddate">Get Analytics</button>
            <a class="btn btn-lg btn-primary" target="_blank" ng-show="analytics.queue_activity.length > 0" href="{{ url('/business/advanced-analytics/' . $business_id) }}">Advanced Analytics</a>
        </div>
    </form>
</div>
<table class="table">
    <tbody>
    <tr>
        <td style="padding-top: 18px;">
            <p class="title">
                Queued Numbers Remaining:
            </p>
        </td>
        <td style="padding-top: 18px;">@{{ analytics.remaining_count ? analytics.remaining_count : "0" }}</td>
    </tr>
    <tr>
        <td>
            <p class="title">
                Total Numbers Issued:
            </p>
        </td>
        <td>@{{ analytics.total_numbers_issued ? analytics.total_numbers_issued : "0" }}</td>
    </tr>
    <tr>
        <td>
            <p class="title">
                Total Numbers Called:
            </p>
        </td>
        <td>@{{ analytics.total_numbers_called ? analytics.total_numbers_called : "0" }}</td>
    </tr>
    <tr>
        <td>
            <p class="title">
                Total Numbers Served: </p>
        </td>
        <td>@{{ analytics.total_numbers_served ? analytics.total_numbers_served : "0" }}</td>
    </tr>
    <tr>
        <td>
            <p class="title">Total Numbers Dropped:</p>
            </td>
        <td>@{{ analytics.total_numbers_dropped ? analytics.total_numbers_dropped : "0" }}</td>
    </tr>
    <tr>
        <td>
            <p class="title">Average Waiting Time: </p>
            </td> <!-- from number issued to calling -->

        <td>@{{ analytics.average_time_called ? analytics.average_time_called : "0 minute(s) 0 second(s)" }}</td>
    </tr>
    <tr>
        <td>
            <p class="title">Average Serving Time:
            </p>
        </td> <!-- from number called to served -->
        <td>@{{ analytics.average_time_served ? analytics.average_time_served : "0 minute(s) 0 second(s)" }}</td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info" role="alert">
    <strong>FeatherQ Business Analytics</strong> features will be given for <strong>free</strong> for the next few months.
    However, future developments might classify these features to be given exclusively to premium users without prior notice.
</div>