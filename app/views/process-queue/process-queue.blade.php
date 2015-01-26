<html >
<head>
</head>
<body  ng-app="processqueue">
<input type="hidden" id="service-id" value="{{ $service_id }}">
<input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">
<input type="hidden" id="issue-numbers-url" value="{{ url('/processqueue/issuenumber/') }}">
<input type="hidden" id="issue-multiple-url" value="{{ url('/processqueue/issuemultiple/') }}">
<input type="hidden" id="call-number-url" value="{{ url('/processqueue/callnumber/') }}">
<input type="hidden" id="serve-number-url" value="{{ url('/processqueue/servenumber/') }}">
<input type="hidden" id="drop-number-url" value="{{ url('/processqueue/dropnumber/') }}">


<h1>Process Queue Test</h1>

<div ng-controller="processqueueController">
    <select>
        <option ng-repeat="number in uncalled_numbers" value="@{{ number.transaction_number }}">@{{ number.priority_number }}</option>
    </select>
</div>

<div ng-controller="issuenumbersController">
    <button ng-click="issueNumber()">Issue number</button>
</div>


<!-- Scripts -->
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/process-queue/process-queue.js') }}
</body>
</html>