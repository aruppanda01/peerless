<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLoanCreatedNotifiedByOperationDept extends Notification
{
    use Queueable;
    public $user;
    public $loan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$loan)
    {
        $this->user = $user;
        $this->loan = $loan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->greeting('Hello '.$this->user['first_name'].' '.$this->user['last_name'])
                ->subject('New Loan Initialized :)')
                ->line('The loan from '.$this->loan['form_no'] .' is newly Initialized.')
                ->line('Please check & verify that')
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
