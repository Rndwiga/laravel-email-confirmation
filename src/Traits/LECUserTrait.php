<?php
namespace ITB\LEC\Traits;

use ITB\LEC\Models\Confirm;

trait LECUserTrait
{
	public function confirm()
	{
		return $this->hasOne( Confirm::class );
	}
}