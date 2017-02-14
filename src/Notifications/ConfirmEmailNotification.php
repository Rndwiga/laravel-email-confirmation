<?php

namespace ITB\LEC\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
    public function toMail( $notifiable )
    {
        $url = url( '/confirm/email/' . $notifiable->confirm->hash );
        return (new MailMessage)
                    ->subject( trans( 'LEC::LEC.email.subject' ) )
                    ->greeting( trans( 'LEC::LEC.email.greetings', [ 'name' => $notifiable->name ] ) )
                    ->line( trans( 'LEC::LEC.email.message1' ) )
                    ->line( trans( 'LEC::LEC.email.message2' ) )
                    ->line( trans( 'LEC::LEC.email.message3' ) )
                    ->action( trans( 'LEC::LEC.email.action' ), $url );
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
