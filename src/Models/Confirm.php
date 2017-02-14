<?php

namespace ITB\LEC\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Confirm extends Model
{
    protected $table = 'email_confirmations';
    protected $fillable = [
        'is_confirmed',
        'hash',
    ];
    protected $touches = [
        'user',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo( User::class );
    }
}
