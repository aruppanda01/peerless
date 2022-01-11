<?php
function randomGenerator()
{
	return uniqid() . '' . date('ymdhis') . '' . uniqid();
}
function createNotification($sender_user_id,$receiver_user_id, $type)
{
    $title = '';
    $message = '';
    $route = '';
    switch ($type) {
        case 'credit_user_form_submission':
            $title = 'The Credit department just submitted a form';
            $message = 'Please check & review the form';
            $route = 'operation_user.loan.index';
            break;
        case 'revert_back_by_operation_dept':
            $title = 'The Operation department revert back the application form';
            $message = 'Please check & resubmit the form';
            $route = 'credit_user.failedLoanDetails';
            break;
        case 'credit_user_form_re_submission':
            $title = 'The credit department reviewed and resubmitted the form';
            $message = 'Please check & review the form';
            $route = 'operation_user.loan.index';
            break;
        case 'operation_dept_submit_a_form':
            $title = 'The Operation department just submitted a form';
            $message = 'Please check & review the form';
            $route = 'accountant_user.loan.index';
            break;
        case 'revert_back_by_account_dept':
            $title = 'The Account department revert back the application form';
            $message = 'Please check & resubmit the form';
            $route = 'operation_user.failedLoanDetails';
            break;
        case 'loan_created_by_accountant':
            $title = 'The Account department just created a new loan';
            $message = 'Please check & review the form';
            $route = 'operation_user.failedLoanDetails';
            break;
        case 'operation_user_form_re_submission':
            $title = 'The Operation department reviewed and resubmitted the form';
            $message = 'Please check & review the form';
            $route = 'accountant_user.loan.index';
            break;
    }
    $notification = [];
    $notification[] = [
        'sender_user_id' => $sender_user_id,
        'receiver_user_id' => $receiver_user_id,
        'type' => $type,
        'title' => $title,
        'message' => $message,
        'route' => $route,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    if (count($notification) > 0) {
        \App\Models\Notification::insert($notification);
    }
    return $notification;
}

function getAsiaTime($date)
{
	$date = new DateTime($date);
	$timezone = new DateTimeZone('Asia/Kolkata');
	$set_timezone =  $date->setTimezone($timezone)->format('h:i A');
	return $set_timezone;
}
