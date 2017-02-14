<?php
namespace ITB\LEC\Listeners;

use Illuminate\Auth\Events\Registered;
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
     * @param  Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle( Registered $event )
    {
    	Satellite::createConfirmationProcedure( $event->user );
    }
}
