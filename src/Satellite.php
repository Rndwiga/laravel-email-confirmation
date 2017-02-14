<?php
namespace ITB\LEC;

class Satellite
{
    public static function makeHash( $length )
    {
        return str_random( $length );
    }
}
