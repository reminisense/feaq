<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:21 PM
 */

class QueueTransaction extends Eloquent{

  protected $table = 'queue_transaction';
  protected $primaryKey = 'transaction_number';
  public $timestamps = false;

  /*========================
   * retrieve methods
   =======================*/

  public static function terminalId($transaction_number){
    return QueueTransaction::where('transaction_number', '=', $transaction_number)->first()->terminal_id;
  }


  /*===========================
   * update and create methods
   ============================*/

  /**
   * updates the time called of a particular transaction
   * @param unknown $transaction_number
   * @param string $time_called
   */
  public static function updateTransactionTimeCalled($transaction_number, $time_called = null, $terminal_id = null){
    //$values['login_id'] = $login_id;
    $values['time_called'] = $time_called == null ? time() : $time_called;
    if(isset($terminal_id))$values['terminal_id'] =  $terminal_id;  //Adds terminal id to terminal transaction to bypass hooking of terminals
    QueueTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    Helper::dbLogger('QueueTransaction', 'terminal_transaction', 'update', 'updateTransactionTimeCalled', User::email(Helper::userId()), 'transaction_number:' . $transaction_number);
  }

  /**
   * updates the time completed of a particular transaction
   * @param unknown $transaction_number
   * @param string $time_completed
   */
  public static function updateTransactionTimeCompleted($transaction_number, $time_completed = null){
    $values['time_completed'] = $time_completed == null ? time() : $time_completed;
    QueueTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    Helper::dbLogger('QueueTransaction', 'terminal_transaction', 'update', 'updateTransactionTimeCompleted', User::email(Helper::userId()), 'transaction_number:' . $transaction_number);
  }

  /**
   * updates the time removed of a particular transaction
   * @param unknown $transaction_number
   * @param string $time_removed
   */
  public static function updateTransactionTimeRemoved($transaction_number, $time_removed = null){
    $values['time_removed'] = $time_removed == null ? time() : $time_removed;
    QueueTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    Helper::dbLogger('QueueTransaction', 'terminal_transaction', 'update', 'updateTransactionTimeRemoved', User::email(Helper::userId()), 'transaction_number:' . $transaction_number);
  }

  public static function getTimesByTransactionNumber($transaction_number) {
    return QueueTransaction::where('transaction_number', '=', $transaction_number)->select(array('time_queued', 'time_completed', 'time_removed'))->get();
  }

  public static function terminalActiveNumbers($terminal_id, $date = null){
    $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
    $results = QueueTransaction::where('terminal_id', '=', $terminal_id)
      ->where('time_queued', '!=', 0)
      ->where('time_completed', '=', 0)
      ->where('time_removed', '=', 0)
      ->where('date', '=', $date)
      ->get()
      ->toArray();
    return $results ? count($results) : 0;
  }

  public static function queueStatus($transaction_number){
    $number = QueueTransaction::where('transaction_number', '=', $transaction_number)->first();

    $called = $number->time_called != 0 ? TRUE : FALSE;
    $served = $number->time_completed != 0 ? TRUE : FALSE;
    $removed = $number->time_removed != 0 ? TRUE : FALSE;

    if(!$called && !$removed){
      return 'Queueing';
    }else if($called && !$served && !$removed){
      return 'Called';
    }else if($called && !$served && $removed){
      return 'Dropped';
    }else if(!$called && $removed){
      return 'Removed';
    }else if($called && $served){
      return 'Served';
    }else{
      return 'Error';
    }
  }

  public static function priorityNumber($transaction_number){
    return QueueTransaction::where('transaction_number', '=', $transaction_number)->first()->priority_number;
  }

  public static function name($transaction_number){
    return QueueTransaction::where('transaction_number', '=', $transaction_number)->first()->name;
  }

  public static function email($transaction_number){
    return QueueTransaction::where('transaction_number', '=', $transaction_number)->first()->email;
  }

  public static function phone($transaction_number){
    return QueueTransaction::where('transaction_number', '=', $transaction_number)->first()->phone;
  }

  public static function userId($transaction_number) {
    return QueueTransaction::where('transaction_number', '=', $transaction_number)
      ->first()->user_id;
  }

  public static function updatePriorityQueueUser($transaction_number, $name = null, $phone = null, $email = null){
    $values = [
      'name' => $name,
      'phone' => $phone,
      'email' => $email,
    ];
    QueueTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    Helper::dbLogger('QueueTransaction', 'priority_queue', 'update', 'updatePriorityQueueUser', $email, 'transaction_number:' . $transaction_number);
  }

  public static function getLatestTransactionNumberOfUser($user_id){
    $transaction = QueueTransaction::where('user_id', '=', $user_id)->orderBy('transaction_number', 'desc')->first();
    return isset($transaction->transaction_number) ? $transaction->transaction_number : null;
  }

  public static function createTransactionRecord($service_id, $last_number_given, $current_number, $date, $priority_number, $user_id, $queue_platform, $time_queued, $terminal_id = null){
    $values = [
      'service_id' => $service_id,
      'last_number_given' => $last_number_given,
      'current_number' => $current_number,
      'date' => $date,
      'priority_number' => $priority_number,
      'user_id' => $user_id,
      'queue_platform' => $queue_platform,
      'time_queued' => $time_queued,
      'business_id' => Business::getBusinessIdByServiceId($service_id),
      'branch_id' => Service::branchId($service_id),
    ];
    if($terminal_id) $values['terminal_id'] = $terminal_id;
    return QueueTransaction::insertGetId($values);
  }

  public static function setConfirmationCodeByTransactionNumber($confirmation_code, $transaction_number) {
    QueueTransaction::where('transaction_number', '=', $transaction_number)->update(array('confirmation_code' => $confirmation_code));
  }

  public static function serviceId($transaction_number){
    return QueueTransaction::find($transaction_number)->service_id;
  }

  public static function getPriorityNumberByServiceId($service_id) {
    return QueueTransaction::where('service_id', '=', $service_id)->select(array('priority_number'))->get();
  }

  public static function setTimeAssignedByTransactionNumber($time_assigned, $transaction_number) {
    QueueTransaction::where('transaction_number', '=', $transaction_number)->update(['time_assigned' => $time_assigned]);
  }

  public static function queueNumberExists($date, $email) {
    $count = QueueTransaction::where('date', '=', $date)
      ->where('email', '=', $email)
      ->select(DB::raw('COUNT(*) as number_exists'))
      ->first()
      ->number_exists;
    return $count > 0 ? TRUE : FALSE;
  }

  public static function getTransactionNumbersByServiceId($service_id) {
    return QueueTransaction::where('service_id', '=', $service_id)->select(array('transaction_number'))->get();
  }

  public static function queuedNumbers($service_id, $date){
    return QueueTransaction::where('service_id', '=', $service_id)->where('date', '=', $date)->get();
  }
}