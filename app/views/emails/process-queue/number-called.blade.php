<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Your number has been called!</h2>

<div>
    <p>Hello{{ $name }}!</p>
    <p>Thank you for using FeatherQ!</p>
    <p>Your number (# {{ $priority_number }}) has been called by {{ $terminal_name }} in {{ $business_name }}.</p>
    <p>To know more about the status of your queue, log on to <a href="http://featherq.com">FeatherQ.com</a></p>
</div>
</body>
</html>
