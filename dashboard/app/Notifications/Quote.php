<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Quote extends Notification
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

    /** Función para la estructura del correo
     * Se define la estrutura que llevará el contenido del correo
     * Los parametros son enviados del controlador QuoteRequestController en la función store
     * Se puede modificar la vista del correo en la carpeta views/vendor/ 
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New MVM Manual Form')
                    ->line($this->globalQuote['nameClient'])
                    ->line($this->globalQuote['phoneClient'])
                    ->line($this->globalQuote['serviceClient'])
                    ->line($this->globalQuote['emailClient'])
                    ->line($this->globalQuote['addressClient'])
                    ->action($this->globalQuote['textButton'], $this->globalQuote['url']);
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
