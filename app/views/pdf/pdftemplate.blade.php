<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Getting started | FeatherQ</title>
</head>

<body style="font-family: 'Arial', sans-serif;">
  <div style="height:92px;background-color:#cdced0;text-align:center;margin-bottom:12px;border-bottom:1px dashed #777;">
    <img src="{{ url('/images/ins.png') }}"/>
  </div>
  <div style="height:90px;background-color:#cf6733;text-align:center;">
    <img src="{{ url('/images/logo.png') }}"/>
  </div>
  <div style="text-align:center;">
    <h1 style="font-weight:800;font-size:32px; margin-top: 40px;margin-bottom:12px;">{{ $business_name }}</h1>
    <p style="font-size:22px;color:#282828; margin-top:3px;">{{ $business_address }}</p><br>
  </div>
  <div style="text-align:center;background:url('/images/border.png') center center no-repeat;width:353px; height:353px; margin: 30px 0; margin: auto;">
    <img style="margin-top:26px;" width="302" height="302" src="{{ $qr_code }}"/>
  </div>
  <div style="text-align:center;">
    <br>
    <h1 style="font-weight:800;font-size:32px; margin-top: 20px; margin-bottom:5px;">Scan this QR Code</h1>
    <p style="font-size:22px;color:#282828; margin-top:2px;">to view our Broadcast Screen</p>
    <p style="font-size:22px;color:#282828; margin-top:2px;">or</p>
    <p style="font-size:22px;color:#282828; margin-top:2px;">Visit the link below</p>
    <h1 style="font-weight:800;font-size:30px; margin-top: 20px; margin-bottom:5px;">{{ $shortlink }}</h1>
  </div>
</body>
</html>
