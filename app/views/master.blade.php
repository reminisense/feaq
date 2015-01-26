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
    <script>
        FeatherQ.facebook.statusChangeCallback();
        FeatherQ.facebook.checkLoginState();
        FeatherQ.facebook.fbAsyncInit();
        FeatherQ.facebook.loadSDK();
    </script>
    @yield('body')
</body>
</html>