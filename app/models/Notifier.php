<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/9/15
 * Time: 2:33 PM
 */

class Notifier extends Eloquent{
    /***Temp**/
    public static $frontline_sms_secret = 'Reminisense!1';
    public static $frontline_sms_url = 'https://cloud.frontlinesms.com/api/1/webconnection/3225';

    public $timestamps = false;

    public static function sendNumberCalledToAllChannels($transacion_number){
        Notifier::sendNumberCalledEmail($transacion_number);
        Notifier::sendNumberCalledSms($transacion_number);
    }

    public static function sendNumberCalledEmail($transaction_number){
        $email = PriorityQueue::email($transaction_number);
        $name = PriorityQueue::name($transaction_number);
        if($email){
            $terminal_id = TerminalTransaction::terminalId($transaction_number);
            $data = [
                'name' => $name == null ? null : ' ' . $name,
                'priority_number' => PriorityQueue::priorityNumber($transaction_number),
                'terminal_name' => Terminal::name($terminal_id),
                'business_name' => Business::name(Business::getBusinessIdByTerminalId($terminal_id)),
            ];
            Notifier::sendEmail($email, 'emails.process-queue.number-called', 'FeatherQ Message: Your number has been called.', $data);
        }
    }

    public static function sendNumberCalledSms($transaction_number){
        $phone = PriorityQueue::phone($transaction_number);
        $name = PriorityQueue::name($transaction_number);
        if($phone){
            $name = $name == null ? null : ' ' . $name;
            $priority_number = PriorityQueue::priorityNumber($transaction_number);
            $terminal_id = TerminalTransaction::terminalId($transaction_number);
            $terminal_name =  Terminal::name($terminal_id);
            $business_name = Business::name(Business::getBusinessIdByTerminalId($terminal_id));
            $message = "Hello$name! Thank you for using FeatherQ. Your number (# $priority_number ) has been called by $terminal_name in $business_name.";
            Notifier::sendFrontlineSMS($message, $phone, Notifier::$frontline_sms_url, Notifier::$frontline_sms_secret);
        }

    }

    public static function sendEmail($email, $template, $subject, $data = array()){
        Mail::send($template, $data, function($message) use($email , $subject){
            $message->subject($subject);
            $message->to($email);
        });
    }

    public static function sendFrontlineSMS($message, $phone, $url, $secret){
        $request = [
            'secret' => $secret,
            'message' => $message,
            'recipients' => [
                    ['type' => 'address', 'value' => "$phone"]
            ]
        ];

        //php_curl.dll must be enabled for the ff. code to work
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($request) );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}