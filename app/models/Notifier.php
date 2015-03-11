<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/9/15
 * Time: 2:33 PM
 */

class Notifier extends Eloquent{
    public $timestamps = false;

    public static function sendNumberCalledNotification($transaction_number){
        Notifier::sendNumberCalledToAllChannels($transaction_number);
        Notifier::sendNumberCalledToNextNumber($transaction_number, 1);
        Notifier::sendNumberCalledToNextNumber($transaction_number, 5);
        Notifier::sendNumberCalledToNextNumber($transaction_number, 10);
    }

    public static function sendNumberCalledToAllChannels($transaction_number){
        Notifier::sendNumberCalledEmail($transaction_number);
        Notifier::sendNumberCalledSms($transaction_number);
    }

    public static function sendNumberNextToAllChannels($transaction_number){
        Notifier::sendNumberNextEmail($transaction_number);
        Notifier::sendNumberNextSms($transaction_number);
    }

    public static function sendNumberCalledToNextNumber($transaction_number, $diff){
        $number = TerminalTransaction::where('transaction_number', '>=', $transaction_number)->skip($diff)->first();
        if($number){
            Notifier::sendNumberNextToAllChannels($number->transaction_number);
        }
    }

    /**
     * Email sending templates
     */

    public static function sendNumberCalledEmail($transaction_number){
        $email = PriorityQueue::email($transaction_number);
        $name = PriorityQueue::name($transaction_number);
        if($email){
            $terminal_id = TerminalTransaction::terminalId($transaction_number);
            $data = [
                'name' => $name == null ? null : ' ' . $name,
                'priority_number' => PriorityQueue::priorityNumber($transaction_number),
                'terminal_name' => $terminal_id != 0 ? Terminal::name($terminal_id) : '',
                'business_name' => $terminal_id != 0 ? Business::name(Business::getBusinessIdByTerminalId($terminal_id)) : '',
            ];
            Notifier::sendEmail($email, 'emails.process-queue.number-called', 'FeatherQ Message: Your number has been called.', $data);
        }
    }

    public static function sendNumberNextEmail($transaction_number){
        $email = PriorityQueue::email($transaction_number);
        $name = PriorityQueue::name($transaction_number);
        if($email){
            $data = [
                'name' => $name == null ? null : ' ' . $name,
                'priority_number' => PriorityQueue::priorityNumber($transaction_number),
            ];
            Notifier::sendEmail($email, 'emails.process-queue.number-next', 'FeatherQ Message: Your number will be called soon.', $data);
        }
    }

    /**
     * Sms sending templates
     */

    public static function sendNumberCalledSms($transaction_number){
        $phone = PriorityQueue::phone($transaction_number);
        $name = PriorityQueue::name($transaction_number);
        if($phone){
            $terminal_id = TerminalTransaction::terminalId($transaction_number);
            $service_id = Terminal::serviceId($terminal_id);
            $name = $name == null ? null : ' ' . $name;
            $priority_number = PriorityQueue::priorityNumber($transaction_number);
            $terminal_name = $terminal_id != 0 ? Terminal::name($terminal_id) : '';
            $business_name = $terminal_id != 0 ? Business::name(Business::getBusinessIdByTerminalId($terminal_id)) : '';
            $message = "Hello$name! Thank you for using FeatherQ. Your number (# $priority_number ) has been called by $terminal_name in $business_name. To know more about the status of your queue, log on to FeatherQ.com.";
            Notifier::sendServiceSms($message, $phone, $service_id);
        }
    }

    public static function sendNumberNextSms($transaction_number){
        $phone = PriorityQueue::phone($transaction_number);
        $name = PriorityQueue::name($transaction_number);
        if($phone){
            $pq = Helper::firstFromTable('priority_queue', 'transaction_number', $transaction_number);
            $service_id = PriorityNumber::serviceId($pq->track_id);
            $name = $name == null ? null : ' ' . $name;
            $priority_number = PriorityQueue::priorityNumber($transaction_number);
            $message = "Hello$name! Thank you for using FeatherQ. Your number (# $priority_number ) will be called soon. To know more about the status of your queue, log on to FeatherQ.com.";
            Notifier:: sendServiceSms($message, $phone, $service_id);
        }
    }

    public static function sendServiceSms($message, $phone, $service_id){
        $url = QueueSettings::frontlineUrl($service_id);
        $secret = QueueSettings::frontlineSecret($service_id);
        Notifier::sendFrontlineSMS($message, $phone, $url, $secret);
    }

    /**
     * Core sending functions
     */

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