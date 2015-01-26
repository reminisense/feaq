@extends('master')

@section('scripts')
    {{ HTML::script('js/user/user.js') }}
@stop

@section('body')

<script>
    FeatherQ.facebook.statusChangeCallback();
    FeatherQ.facebook.checkLoginState();
    FeatherQ.facebook.fbAsyncInit();
    FeatherQ.facebook.loadSDK();
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email,user_friends" onlogin="FeatherQ.facebook.checkLoginState();" id="login">
</fb:login-button>
<input type="button" value="Logout" id="logout" style="display: none;" />

<div id="status">
</div>
<div id="scary-data">

</div>
<div id="friends">

</div>

@stop