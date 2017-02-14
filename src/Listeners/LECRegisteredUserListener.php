<?php
namespace ITB\LEC\Listeners;

use Notification;
use Illuminate\Auth\Events\Registered;
use ITB\LEC\Events\LECRegisteredUserEvent;
use ITB\LEC\Notifications\ConfirmEmailNotification;
use ITB\LEC\Satellite;

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
     * @param  LECRegisteredUserEvent  $event
     * @return void
     */
    public function handle( Registered $event )
    {
        $User = $event->user;
        $User->confirm()->create([
            'is_confirmed' => false,
            'hash'         => Satellite::makeHash(23),
        ]);
        Notification::send( $User, new ConfirmEmailNotification( $User ) );
    }
}
