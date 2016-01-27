<html>
<head>

</head>
<body>
<form method="post" action="{{url('/user/send-reset')}}">
    <label>Email</label>
    <input type="text" name="email">
    <button type="submit">Reset Password</button>
</form>
</body>
</html>