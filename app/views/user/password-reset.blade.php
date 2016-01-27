<html>
<head>

</head>
<body>
    <form method="post" action="{{url('/user/password-reset')}}">
        <input type="hidden" name="user_id" value="{{ $user_id }}"/>
        <label>Password</label>
        <input type="password" name="password">
        <label>Confirm Password</label>
        <input type="password" name="password_confirm">
        <button type="submit">Submit</button>
    </form>
    <div>
        @if($error)<p>{{ $error }}</p>@endif
    </div>
</body>
</html>