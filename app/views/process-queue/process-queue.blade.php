<html >
<head>
</head>
<body  ng-app="processqueue">
<input type="hidden" id="service-id" value="{{ $service_id }}">
<input type="hidden" id="terminal-id" value="{{ $terminal_id }}">
<input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">
<input type="hidden" id="issue-numbers-url" value="{{ url('/processqueue/issuenumber/') }}">
<input type="hidden" id="issue-multiple-url" value="{{ url('/processqueue/issuemultiple/') }}">
<input type="hidden" id="call-number-url" value="{{ url('/processqueue/callnumber/') }}">
<input type="hidden" id="serve-number-url" value="{{ url('/processqueue/servenumber/') }}">
<input type="hidden" id="drop-number-url" value="{{ url('/processqueue/dropnumber/') }}">


<h1>Process Queue Test</h1>

<div ng-controller="issuenumbersController">
    <button ng-click="issueNumber()">Issue number</button>
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