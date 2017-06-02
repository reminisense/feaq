//var websocket_url = "ws://192.168.8.101:55346/socket/server.php";
//var mailsocket_url = "ws://192.168.8.101:55346/mail/server.php";
var websocket_url = "ws://127.0.0.1:55346/socket/server.php";
var mailsocket_url = "ws://127.0.0.1:55346/mail/server.php";

//$(document).ready(function() {

  // $('#show-all-numbers').click(function(e) {
  //   e.preventDefault();
  //   sessionStorage.setItem("service_id", "0");
  //   sessionStorage.setItem("terminal_id", "0");
  //   sessionStorage.setItem("broadcast_spec", "boxed business-spec");
  //   window.location.reload(true);
  // });

//  $('#show-only-service').change(function(e) {
//    e.preventDefault();
//    var service_id_select = $('#show-only-service option:selected').attr('service_id');
//    var service_name_select = $('#show-only-service option:selected').text();
//    if (service_id_select == "all") {
//      sessionStorage.setItem("service_id", "0");
//      sessionStorage.setItem("terminal_id", "0");
//      sessionStorage.setItem("broadcast_spec", "boxed business-spec");
//    }
//    else {
//      sessionStorage.setItem("service_id", service_id_select);
//      sessionStorage.setItem("service_name", service_name_select);
//      sessionStorage.setItem("terminal_id", "0");
//      sessionStorage.setItem("broadcast_spec", "boxed service-spec");
//    }
//    window.location.reload(true);
//  });

  // $('#filter-broadcast .show-only-terminal').click(function(e) {
  //   e.preventDefault();
  //   sessionStorage.setItem("terminal_id", $(this).attr('terminal_id'));
  //   sessionStorage.setItem("service_name", $(this).attr('service_name'));
  //   sessionStorage.setItem("terminal_name", $(this).text());
  //   sessionStorage.setItem("service_id", "0");
  //   sessionStorage.setItem("broadcast_spec", "boxed terminal-spec");
  //   window.location.reload(true);
  // });

//});