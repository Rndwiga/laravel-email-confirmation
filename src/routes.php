<?php
if ( config( 'app.debug' ) == true )
{
	\Artisan::call( 'view:clear' );
}
Route::group( [ 'middleware' => [ 'web' ] ], function ()
{
	Route::get( 'email/{hash}', 'ConfirmController@getConfirm' );
	Route::get( 'repeat', 'ConfirmController@getRepeatConfirm' );
	Route::get( 'successfull', 'ConfirmController@getSuccessfull' );
	Route::get( 're-sent', 'ConfirmController@getResent' );
	Route::get( 'warning', 'ConfirmController@getWarning' );
	Route::post( 'email', 'ConfirmController@postConfirm' );
	Route::post( 'repeat', 'ConfirmController@postRepeatConfirm' );
} );
