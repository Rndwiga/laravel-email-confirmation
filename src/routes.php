<?php
if ( config( 'app.debug' ) == true )
{
	\Artisan::call( 'view:clear' );
}
Route::group(['middleware' => ['web']], function ()
{
	Route::get(  'email/{hash}', 'ConfirmController@getConfirm'        );
	Route::post( 'email',        'ConfirmController@postConfirm'       );
	Route::get(  'repeat',       'ConfirmController@getRepeatConfirm'  );
	Route::post( 'repeat',       'ConfirmController@postRepeatConfirm' );
	Route::get(  'successfull',  'ConfirmController@getSuccessfull'    );
	Route::get(  're-sent',      'ConfirmController@getResent'         );
});
