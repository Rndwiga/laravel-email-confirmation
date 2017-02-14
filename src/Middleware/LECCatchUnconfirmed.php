<?php
namespace ITB\LEC\Middleware;

use Closure;
use ITB\LEC\Satellite;
use Notification;
use ITB\LEC\Notifications\ConfirmEmailNotification;


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
				if ( !is_null( auth()->user()->confirm ) )
				{
					if ( !auth()->user()->confirm->is_confirmed )
					{
						if ( is_null( auth()->user()->confirm->hash ) )
						{
							auth()->user()->confirm->hash = Satellite::makeHash( 23 );
							auth()->user()->confirm->save();
							Notification::send( auth()->user(), new ConfirmEmailNotification( auth()->user() ) );
						}
						return redirect( config( 'LEC.route_prefix' ) . '/warning' );
					}
				}
				else
				{
					Satellite::createUnconfirmed( auth()->user() );
					Notification::send( auth()->user(), new ConfirmEmailNotification( auth()->user() ) );
					return redirect( config( 'LEC.route_prefix' ) . '/warning' );
				}
			}
		}
		return $next( $request );
	}
}
