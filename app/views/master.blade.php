<!DOCTYPE html>
<html>
<head>
    @yield('styles')
    {{ HTML::script('js/jquery-1.11.2.min.js') }}
    {{ HTML::script('js/FeatherQ.js') }}
    @yield('scripts')
    <title>FeatherQ</title>
    <meta charset="UTF-8">
</head>
<body>
    @yield('body')
</body>
</html>