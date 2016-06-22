<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$layoutView =  View::make('default.index', [
		    'fullscreen_above' => '',
		    'fullscreen_below' => '',
		    'top_bar' => '',
		    'top_center' => '',
		    'top_right' => '',
		    'upper_third' => '',
		    'middle_center' => '',
		    'lower_third' => '',
		    'bottom_bar' => '',
		    'bottom_left' => '',
		    'bottom_right' => ''
		]);
		
		\Event::fire('cooglemirror.render', [$layoutView]);
		
		return $layoutView;
	}

}
