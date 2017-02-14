<?php
namespace ITB\LEC;

use App\User;
use Notification;
use ITB\LEC\Notifications\ConfirmEmailNotification;
use ITB\LEC\Models\Confirm;

class Satellite
{
    /**
     * @return void
     */
    public static function makeHash( $length = 23 )
    {
        return str_random( $length );
    }

    /**
     * @return void
     */
    public static function createUnconfirmed( User $User )
    {
        $User->confirm()->create([
            'is_confirmed' => false,
            'hash'         => self::makeHash(23),
        ]);
    }
}
