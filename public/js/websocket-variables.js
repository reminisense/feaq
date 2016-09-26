var websocket_url = "ws://188.166.234.33:443/socket/server.php";
var mailsocket_url = "ws://188.166.234.33:443/mail/server.php";

$(document).ready(function() {

  $('#show-all-numbers').click(function(e) {
    e.preventDefault();
    sessionStorage.setItem("service_id", "0");
    sessionStorage.setItem("terminal_id", "0");
    sessionStorage.setItem("broadcast_spec", "boxed business-spec");
    window.location.reload(true);
  });

  $('#filter-broadcast .show-only-service').click(function(e) {
    e.preventDefault();
    sessionStorage.setItem("service_id", $(this).attr('service_id'));
    sessionStorage.setItem("service_name", $(this).text());
    sessionStorage.setItem("terminal_id", "0");
    sessionStorage.setItem("broadcast_spec", "boxed service-spec");
    window.location.reload(true);
  });

  $('#filter-broadcast .show-only-terminal').click(function(e) {
    e.preventDefault();
    sessionStorage.setItem("terminal_id", $(this).attr('terminal_id'));
    sessionStorage.setItem("service_name", $(this).attr('service_name'));
    sessionStorage.setItem("terminal_name", $(this).text());
    sessionStorage.setItem("service_id", "0");
    sessionStorage.setItem("broadcast_spec", "boxed service-spec");
    window.location.reload(true);
  });

});