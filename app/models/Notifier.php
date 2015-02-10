<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/9/15
 * Time: 2:33 PM
 */

class Notifier extends Eloquent{
    public $timestamps = false;

    public static function sendNumberCalledToAllChannels($transacion_number){
        Notifier::sendNumberCalledEmail($transacion_number);
        Notifier::sendNumberCalledSms($transacion_number);
    }

    public static function sendNumberCalledEmail($transaction_number){
        $email = PriorityQueue::email($transaction_number);
        if($email){
            $terminal_id = TerminalTransaction::terminalId($transaction_number);
            $data = [
                'priority_number' => PriorityQueue::priorityNumber($transaction_number),
                'terminal_name' => Terminal::name($terminal_id),
                'business_name' => Business::name(Business::getBusinessIdByTerminalId($terminal_id)),
            ];
            Notifier::sendEmail($email, 'emails.process-queue.number-called', 'FeatherQ Message: Your number has been called.', $data);
        }
    }

    public static function sendNumberCalledSms($transaction_number){
        $phone = PriorityQueue::phone($transaction_number);
    }

    public static function sendEmail($email, $template, $subject, $data = array()){
        Mail::send($template, $data, function($message) use($email , $subject){
            $message->subject($subject);
            $message->to($email);
        });
    }
}