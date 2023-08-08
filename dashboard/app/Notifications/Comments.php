<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Comments extends Notification
{
    use Queueable;
    private $globalQuote;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($globalQuote)
    {
        $this->globalQuote = $globalQuote;
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
                    ->subject('New Comment')
                    ->line($this->globalQuote['addressClient'])
                    ->line($this->globalQuote['nameClient'])
                    ->line($this->globalQuote['comment'])
                    ->line($this->globalQuote['user']);
    }

    public function build(){
        return $this->view('vendor.notifications.comments');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
