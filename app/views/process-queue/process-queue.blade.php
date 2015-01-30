<html >
<head>
</head>
<body  ng-app="processqueue">
<input type="hidden" id="service-id" value="{{ $service_id }}">
<input type="hidden" id="terminal-id" value="{{ $terminal_id }}">
<input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">
<input type="hidden" id="call-number-url" value="{{ url('/processqueue/callnumber/') }}">
<input type="hidden" id="serve-number-url" value="{{ url('/processqueue/servenumber/') }}">
<input type="hidden" id="drop-number-url" value="{{ url('/processqueue/dropnumber/') }}">

<input type="hidden" id="issue-numbers-url" value="{{ url('/issuenumber/single/') }}">
<input type="hidden" id="issue-multiple-url" value="{{ url('/issuenumber/multiple/') }}">
<input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">

<input type="hidden" id="queue-settings-get-url" value="{{ url('/queuesettings/allvalues/') }}">
<input type="hidden" id="queue-settings-update-url" value="{{ url('/queuesettings/update/') }}">

<h1>Process Queue Test</h1>


<div ng-controller="queuesettingsController">
    Number Start <input type="text" name="number_start" ng-model="number_start" ng-blur="updateNumberStart(number_start)"><br>
    Number Limit <input type="text" name="number_limit" ng-model="number_limit" ng-blur="updateNumberLimit(number_limit)"><br>
    <br>
    Auto Issue<input type="checkbox" name="auto_issue" ng-model="auto_issue" ng-change="updateAutoIssue(auto_issue)"><br>
    Allow SMS<input type="checkbox" name="allow_sms" ng-model="allow_sms" ng-change="updateAllowSms(allow_sms)"><br>
    Allow Remote<input type="checkbox" name="allow_remote" ng-model="allow_remote" ng-change="updateAllowRemote(allow_remote)"><br>

    <button>Save</button>
</div>
<br><br>


<div ng-controller="issuenumbersController">
    <div>
        <input type="text" name="priority_number" ng-model="priority_number"><br>
        <input type="text" name="name" ng-model="name"><br>
        <input type="text" name="phone" ng-model="phone"><br>
        <input type="text" name="email" ng-model="email"><br>
        <button ng-click="issueSpecific(priority_number, name, phone, email)">Issue</button>
    </div>
    <br>
    <button ng-click="issueNumber()">Issue number</button>
    <br>
    <input type="text" ng-model="range">
    <button ng-click="issueMultiple(range)">Issue Multiple</button>
</div>
<br><br>

<div ng-controller="queuesettingsController">

</div>
<br><br>


<div ng-controller="processqueueController">
    <select id="called-number" ng-model="called_number">
        <option value="">Please select a number</option>
        <option ng-repeat="number in uncalled_numbers" value="@{{ number.transaction_number }}">@{{ number.priority_number }}</option>
    </select>
    <button ng-click="callNumber(called_number)">Call</button>

    <table>
        <tr ng-repeat="number in called_numbers">
            <td>@{{ number.priority_number }}</td>
            <td>@{{ number.confirmation_code }}</td>
            <td><button ng-click="dropNumber(number.transaction_number)">Drop</button></td>
            <td><button ng-click="serveNumber(number.transaction_number)">Serve</button></td>
        </tr>
    </table>

    <table>
        <tr ng-repeat="number in processed_numbers">
            <td>@{{ number.priority_number }}</td>
            <td>@{{ number.status }}</td>
        </tr>
    </table>

</div>



<!-- Scripts -->
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/process-queue/process-queue.js') }}
</body>
</html>