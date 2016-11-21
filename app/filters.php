<?php

use Alexa\Request\IntentRequest;
/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('localhost', function() 
{
    switch(Request::server('HTTP_HOST')) {
        case 'mirror.coogle.local':
        case gethostbyname('mirror.coogle.local'):
        case 'localhost':
            return;
    }
    
    return "Go away";
});

Route::filter("alexa-ask", function() 
{
    try {
        $alexaRequest = @\Alexa\Request\Request::fromData(\Request::json()->all());
    } catch(\Exception $e) {
        
    }
    
    if($alexaRequest instanceof IntentRequest) {
        //$alexaRequest->validate();
        return;
    }
    
    return 'Go away';
});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.twilio', function() 
{
    $twilioValidator = new Services_Twilio_RequestValidator(\Config::get('services.twilio.token'));
    
    // juggling the URL behind the ngrok proxy
    $url = str_replace("http://", "https://", str_replace("ngrok.tunnel", "coogle-mirror.ngrok.io", \Request::url()));
    
    $signature = isset($_SERVER['HTTP_X_TWILIO_SIGNATURE']) ? $_SERVER['HTTP_X_TWILIO_SIGNATURE'] : '';
    
    $isTwilio = $twilioValidator->validate($signature, $url, $_POST);
    
    if(!$isTwilio) {
        \App::abort(404);
    }
    
    return;
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
