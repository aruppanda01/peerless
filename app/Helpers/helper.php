<?php
function createNotification($sender_user_id,$receiver_user_id,$form_no, $type)
{
    $title = '';
    $message = '';
    $route = '';
    switch ($type) {
        case 'credit_user_form_submission':
            $title = 'The Credit department just submitted a form, ID :'.$form_no;
            $message = 'Please check & review the form';
            $route = 'operation_user.loan.index';
            break;
        case 'revert_back_by_operation_dept':
            $title = 'The Operation department revert back the application form, ID :'.$form_no;
            $message = 'Please check & resubmit the form';
            $route = 'credit_user.loan.index';
            break;
        case 'credit_user_form_re_submission':
            $title = 'The credit department reviewed and resubmitted the form, ID :'.$form_no;
            $message = 'Please check & review the form';
            $route = 'operation_user.loan.index';
            break;
        case 'operation_dept_submit_a_form':
            $title = 'The Operation department just submitted a form, ID :'.$form_no;
            $message = 'Please check & review the form';
            $route = 'accountant_user.loan.index';
            break;
        case 'revert_back_by_account_dept':
            $title = 'The Account department revert back the application form, ID :'.$form_no;
            $message = 'Please check & resubmit the form';
            $route = 'operation_user.failedLoanDetails';
            break;
        case 'loan_created_by_accountant':
            $title = 'The Account department just submitted a new loan, ID :'.$form_no;
            $message = 'Please check & review the form';
            $route = 'operation_user.failedLoanDetails';
            break;
        case 'operation_user_form_re_submission':
            $title = 'The Operation department reviewed and resubmitted the form, ID :'.$form_no;
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
