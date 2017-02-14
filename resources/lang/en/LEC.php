<?php
return [
	'email' => [
		'subject'   => 'Confirm the E-Mail !',
		'greetings' => 'Hello, :name !',
		'message1'  => 'Your E-Mail not confirmed yet !',
		'message2'  => 'To use all features of our resource, You need to confirm Your E-Mail !',
		'message3'  => 'So, we must warn you that unconfirmed accounts can be blocked until they are confirmed',
		'action'    => 'Confirm E-Mail Now!',
	],
	'view'  => [
		'confirm' => [
			'title'             => 'Confirming the E-Mail',
			'confirm'           => 'Confirm the E-Mail',
			'email'             => 'E-Mail',
			'vcode'             => 'Verification Code',
			'resend'            => 'Re-send confirmation E-Mail',
			'not-found'         => 'User with requested email and/or verification code is not found',
			'return-back'       => 'Return back',
			'something-wrong'   => 'Something wrong',
			'successfull'       => 'You successfully confirmed Your E-Mail !',
			'goto-index'        => 'Go to Main Page',
			'already-confirmed' => 'Your E-Mail already confirmed. You do not need to confrm Your E-Mail again.',
			're-sent'           => 'Confirmation E-Mail is Sent.',
		],
		'warning' => [
			'title'       => 'You did not confirm your E-Mail address!',
			'message'     => '<p>Administrator has restricted your access to the pages that require user confirmation.</p><p>When you register, you have been sent an email with a link to confirm your email address.</p><p>If for any reason it does not, then you can repeat this letter.</p><p>If the message not come in your inbox, it is recommended to check email spam folder - possible mail server identified this letter as spam.</p>',
			'goto-resend' => 'Send Confirmation letter again',
		],
	],
];

