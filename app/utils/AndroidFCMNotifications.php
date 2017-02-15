<?php
/**
 * Created by PhpStorm.
 * User: JONAS
 * Date: 2/15/2017
 * Time: 7:33 PM
 */

class AndroidFCMNotifications {

    private $deviceToken;
    private $message;
    private $msg_type;

    public function __construct($deviceToken, $message, $msg_type){
        $this->deviceToken = $deviceToken;
        $this->message = $message;
        $this->msg_type = $msg_type;


    }

    public function sendNotif(){

        $path_to_form = 'https://fcm.googleapis.com/fcm/send';
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $fields = array
        (
            'to'  => $path_to_form  ,
            'notification' => array(
                'message'=>$this->message,
                'message_type'=>$this->msg_type
            )
        );


        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $path_to_form );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        echo $result;
    }

}