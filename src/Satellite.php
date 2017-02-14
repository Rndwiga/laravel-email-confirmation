<?php
namespace ITB\LEC;

use App\User;
use Notification;
use ITB\LEC\Notifications\ConfirmEmailNotification;

class Satellite
{
    public static function makeHash( $length = 23 )
    {
        return str_random( $length );
    }
    public static function createConfirmationProcedure( User $User )
    {
        $Confirm = $User->confirm;
        if ( !empty( $Confirm ) )
        {
            $Confirm->is_confirmed = false;
            $Confirm->hash = self::makeHash(23);
            $Confirm->save();
        }
        else
        {
            $User->confirm()->create([
                'is_confirmed' => false,
                'hash'         => self::makeHash(23),
            ]);
        }
        Notification::send( $User, new ConfirmEmailNotification( $User ) );
    }
}
