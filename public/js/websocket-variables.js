var websocket_url = "ws://188.166.234.33:443/socket/server.php";
var mailsocket_url = "ws://188.166.234.33:443/mail/server.php";
//var mailsocket_url = "ws://feaq-websocket.local:443/mail/server.php";
//var websocket_url = "ws://localhost:443/socket/server.php";


$(document).ready(function() {

  setDefaultServiceFilter();

  $('#show-only-service li').click(function(e) {
    e.preventDefault();
    sessionStorage.setItem("service_id", $(this).attr('service_id'));
    window.location.reload(true);
  });

});

var setDefaultServiceFilter = function() {
  if (typeof sessionStorage.service_id == "undefined") {
    $('.service-filter-0').addClass("active");
  }
  else {
    $('.service-filter-'+sessionStorage.service_id).addClass("active");
  }
}