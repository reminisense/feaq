<h5>BUSINESS ANALYTICS</h5>
<table class="table">
    <tbody>
    <tr>
        <td style="padding-top: 20px;">Queued Numbers Remaining: </td>
        <td style="padding-top: 20px;">@{{ analytics.remaining_count ? analytics.remaining_count : 0 }}</td>
    </tr>
    <tr>
        <td>Total Numbers Issued: </td>
        <td>@{{ analytics.total_numbers_issued ? analytics.total_numbers_issued : 0 }}</td>
    </tr>
    <tr>
        <td>Total Numbers Called: </td>
        <td>@{{ analytics.total_numbers_called ? analytics.total_numbers_called : 0 }}</td>
    </tr>
    <tr>
        <td>Total Numbers Served: </td>
        <td>@{{ analytics.total_numbers_served ? analytics.total_numbers_served : 0 }}</td>
    </tr>
    <tr>
        <td>Total Numbers Dropped: </td>
        <td>@{{ analytics.total_numbers_dropped ? analytics.total_numbers_dropped : 0 }}</td>
    </tr>
    <tr>
        <td>Average Waiting Time: </td> <!-- from number issued to calling -->
        <td>@{{ analytics.average_time_called ? analytics.average_time_called : 0 }}</td>
    </tr>
    <tr>
        <td>Average Serving Time: </td> <!-- from number called to served -->
        <td>@{{ analytics.average_time_served ? analytics.average_time_served : 0 }}</td>
    </tr>
    </tbody>
</table>
<div class="alert alert-info" role="alert">
    <strong>FeatherQ Business Analytics</strong> features will be given for <strong>free</strong> for the next few months.
    However, future developments might classify these features to be given exclusively to premium users without prior notice.
</div>