<?php
namespace ITB\LEC\Middleware;

use Closure;
use ITB\LEC\Satellite;

/**
 * Class LECCatchUnconfirmed
 * @package ITB\LEC\Middleware
 */
class LECCatchUnconfirmed
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param Activity $Activity
	 * @return mixed
	 */
	public function handle( $request, Closure $next )
	{
		if ( config( 'LEC.catch_unconfirmed' ) === true )
		{
			if ( auth()->check() )
			{
				$User    = auth()->user();
				$Confirm = $User->confirm;
				if ( !is_null( $Confirm ) )
				{
					if ( !$Confirm->is_confirmed )
					{
						if ( is_null( $Confirm->hash ) )
						{
							Satellite::createConfirmationProcedure( $User );
						}
						return redirect( config( 'LEC.route_prefix' ) . '/warning' );
					}
				}
				else
				{
					Satellite::createConfirmationProcedure( $User );
					return redirect( config( 'LEC.route_prefix' ) . '/warning' );
				}
			}
		}
		return $next( $request );
	}
}
