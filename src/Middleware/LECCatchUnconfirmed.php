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
				$User = auth()->user();
				$Confirm = $User->confirm;
				if ( !is_null( $Confirm ) )
				{
					// confirm object exists
					if ( $Confirm->is_confirmed === false )
					{
						// not confirmed - catch them and warn
						return redirect( config( 'LEC.route_prefix' ) . '/warning' );
					}
				}
				else
				{
					// create default confirm related to user object
					Satellite::createConfirmationProcedure( $User );
					// not confirmed - catch them and warn
					return redirect( config( 'LEC.route_prefix' ) . '/warning' );
				}
			}
		}
		return $next( $request );
	}
}
