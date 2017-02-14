<?php
namespace ITB\LEC\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ITB\LEC\Requests\ConfirmEmail;
use ITB\LEC\Requests\ResendEmail;
use ITB\LEC\Satellite;
use App\User;
use Notification;
use ITB\LEC\Notifications\ConfirmEmailNotification;

class ConfirmController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
	 */
	public function postConfirm( ConfirmEmail $request )
	{
		if ( auth()->check() && auth()->user()->confirm->is_confirmed === true )
		{
			return view( 'LEC::auth.confirm.already-confirmed' );
		}
		$email = $request->get( 'email' );
		$vcode = $request->get( 'vcode' );
		$error = [];
		if ( auth()->check() )
		{
			$User = auth()->user();
		}
		else
		{
			$User = User::where( 'email', $email )->first();
		}
		if ( empty( $User ) )
		{
			$error['general'] = trans( 'LEC::LEC.view.confirm.not-found' );
		}
		else
		{
			if ( $User->email == $email )
			{
				$Confirm = $User->confirm;
				if ( !empty($Confirm) && $Confirm->hash == $vcode )
				{
					$Confirm->is_confirmed = true;
					$Confirm->hash         = null;
					$Confirm->save();
					return redirect( '/confirm/successfull' );
				}
				else
				{
					$error['general'] = trans( 'LEC::LEC.view.confirm.not-found' );
				}
			}
			else
			{
				$error['general'] = trans( 'LEC::LEC.view.confirm.not-found' );
			}
		}
		if ( !empty( $error ) )
		{
			return redirect()->back()->withErrors( $error );
		}
		else
		{
			return redirect()->back()->withErrors( [ trans( 'LEC::LEC.view.confirm.something-wrong' ) ] );
		}
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
	 */
	public function postRepeatConfirm( ResendEmail $request )
	{
		$email = $request->get( 'email' );
		if ( auth()->check() )
		{
			$User = auth()->user();
		}
		else
		{
			$User = User::where( 'email', $email )->first();
		}
		if ( !empty( $User ) && $User->email == $email )
		{
			$Confirm = $User->confirm;
			$Confirm->save([
				'is_confirmed' => false,
				'hash'         => Satellite::makeHash(23),
			]);
			Notification::send( $User, new ConfirmEmailNotification( $User ) );
			return redirect( '/confirm/re-sent' );
		}
		else
		{
			return redirect()->back()->withErrors([
				trans( 'LEC::LEC.view.confirm.not-found' )
			]);
		}
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getConfirm( $hash )
	{
		if ( auth()->check() && auth()->user()->confirm->is_confirmed === true )
		{
			return view( 'LEC::auth.confirm.already-confirmed' );
		}
		else
		{
			return view( 'LEC::auth.confirm.email', [ 'hash' => $hash ] );
		}
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getRepeatConfirm()
	{
		return view( 'LEC::auth.confirm.repeat' );
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getSuccessfull()
	{
		return view( 'LEC::auth.confirm.successfull' );
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getResent()
	{
		return view( 'LEC::auth.confirm.re-sent' );
	}

}
