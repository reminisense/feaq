<div class="clearfix header">
    <h5>BUSINESS ANALYTICS</h5>
    <form ng-submit="getBusinessAnalytics(startdate, enddate)">
        <input type="text" id="start-date" name="start-date" class="datepicker" ng-model="startdate"/><b>-</b>
        <input type="text" id="end-date" name="end-date" class="datepicker" ng-model="enddate"/>
        <button class="btn btn-primary" type="submit" ng-disabled="startdate > enddate">Get Analytics</button>
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