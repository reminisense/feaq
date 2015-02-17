<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>FeatherQ Email</title>
</head>
<body bgcolor="#FFFFFF" style="width:600px;margin:auto; font-family:Arial, sans-serif; ">

<table class="head-wrap" bgcolor="#FFFFFF" style="width:600px;">
    <tr>
        <td>
            <img src="http://dev.featherq.com/images/featherq-headerbiz.jpg" alt="featherQ">
        <td>
    </tr>
</table>

<!-- BODY -->
<table class="body-wrap" style="width:600px;margin:auto;">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">
            <div class="content">
                @yield('email_content')
            </div>

        </td>
        <td></td>
    </tr>

</table>

<table style="width:600px; margin-top:20px; text-align:center;">
    <tr>
        <td>
            <p style="font-size:13px;line-height:22px;color: #3c3c3c;">Sincerely, <br>
                FeatherQ Team</p>
        </td>
    </tr>
</table>

<table bgcolor="#bf4d28" style="width:600px; margin-top:20px;">
    <tr>
        <td>
            <p style="text-align:center; color:#fff;font-size:12px;">www.featherq.com</p>
        </td>
    </tr>
</table>

</body>
</html>