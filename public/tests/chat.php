<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8' />
  <style type="text/css">
    <!--
    .chat_wrapper {
      width: 500px;
      margin-right: auto;
      margin-left: auto;
      background: #CCCCCC;
      border: 1px solid #999999;
      padding: 10px;
      font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
    }
    .chat_wrapper .message_box {
      background: #FFFFFF;
      height: 150px;
      overflow: auto;
      padding: 10px;
      border: 1px solid #999999;
    }
    .chat_wrapper .panel input{
      padding: 2px 2px 2px 5px;
    }
    .system_msg{color: #BDBDBD;font-style: italic;}
    .user_name{font-weight:bold;}
    .user_message{color: #88B6E0;}
    -->
  </style>
</head>
<body>
<?php
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script language="javascript" type="text/javascript">
  $(document).ready(function(){
    //create a new WebSocket object.
    var wsUri = "ws://localhost:55346/socket/server.php";
    websocket = new WebSocket(wsUri);

    websocket.onopen = function(ev) { // connection is open
      $('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
    }

    $('#send-btn').click(function(){ //use clicks message send button
      var number = $('#number').val(); //get message text
      var terminal = $('#terminal').val(); //get user name
      var rank = $('#rank').val(); //get user name
      var box = $('#box').val(); //get user name

      if(number == ""){ //empty name?
        alert("please call a number");
        return;
      }
      if(terminal == ""){ //emtpy message?
        alert("please put terminal name");
        return;
      }
      if(rank == ""){ //emtpy message?
        alert("please put terminal id");
        return;
      }
      if(box == ""){ //emtpy message?
        alert("please put the box number you would like the number to show");
        return;
      }

      //prepare json data
      var msg = {
        number: number,
        terminal: terminal,
        rank : rank,
        box : box
      };
      //convert and send data to server
      websocket.send(JSON.stringify(msg));
    });

    //#### Message received from server?
    websocket.onmessage = function(ev) {
      var msg = JSON.parse(ev.data); //PHP sends Json data
      var type = msg.type; //message type
      var number = msg.number; //message text
      var terminal = msg.terminal; //user name
      var rank = msg.rank; //color
      var box = msg.box; //color

      if(type == 'usermsg')
      {
        $('#message_box').append("<div><span class=\"user_name\" style=\"color:#000;\">"+number+"</span> : <span class=\"user_message\">"+rank+" "+terminal+" "+box+"</span></div>");
      }
      if(type == 'system')
      {
        $('#message_box').append("<div class=\"system_msg\">"+terminal+"</div>");
      }

      $('#message').val(''); //reset text
    };

    websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");};
    websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");};
  });
</script>
<div class="chat_wrapper">
  <div class="message_box" id="message_box"></div>
  <div class="panel">
    <input type="text" name="number" id="number" placeholder="Number to call" maxlength="10" style="width:20%"  />
    <input type="text" name="terminal" id="terminal" placeholder="Terminal Name" maxlength="80" style="width:30%" />
    <input type="text" name="rank" id="rank" placeholder="Terminal ID" maxlength="80" style="width:20%" />
    <input type="text" name="box" id="box" placeholder="Box Number" maxlength="80" style="width:20%" />
    <button id="send-btn">Send</button>
  </div>
</div>

</body>
</html>