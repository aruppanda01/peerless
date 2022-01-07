<?php
function randomGenerator()
{
	return uniqid() . '' . date('ymdhis') . '' . uniqid();
}
function createNotification($user,$role_id = 0, $type)
{
    $title = '';
    $message = '';
    $route = '';
    switch ($type) {
        case 'credit_user_form_submission':
            $title = 'Credit user just submitted a form';
            $message = 'Please check & review the form';
            $route = 'operation_user.loan.index';
            break;
    }
    $notification = [];
    $notification[] = [
        'user_id' => $user,
        'type' => $type,
        'title' => $title,
        'message' => $message,
        'role_id' => $role_id,
        'route' => $route,
    ];
    if (count($notification) > 0) {
        \App\Models\Notification::insert($notification);
    }
    return $notification;
}
