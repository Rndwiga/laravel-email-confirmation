<?php
namespace ITB\LEC\Listeners;

use Illuminate\Auth\Events\Registered;
use ITB\LEC\Satellite;
use Notification;
use ITB\LEC\Notifications\ConfirmEmailNotification;

class LECRegisteredUserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle( Registered $event )
    {
        Satellite::createUnconfirmed( $event->user );
        Notification::send( $event->user, new ConfirmEmailNotification( $event->user ) );
    }
}
