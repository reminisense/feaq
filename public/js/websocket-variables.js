var websocket_url = "ws://188.166.234.33:443/socket/server.php";
var mailsocket_url = "ws://188.166.234.33:443/mail/server.php";
//var mailsocket_url = "ws://feaq-websocket.local:443/mail/server.php";
//var websocket_url = "ws://localhost:443/socket/server.php";

$(document).ready(function() {

  $('#show-only-service').change(function() {
    sessionStorage.setItem("service_id", $(this).val());
    window.location.reload(true);
  });

});