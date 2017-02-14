<?php
namespace ITB\LEC\Events;

use Illuminate\Queue\SerializesModels;
use App\User;

class LECRegisteredUserEvent
{
    use SerializesModels;
    /**
     * @var $user
     */
    public $user;
    /**
     * Create a new event instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct( User $user)
    {
        $this->user = $user;
    }
}
