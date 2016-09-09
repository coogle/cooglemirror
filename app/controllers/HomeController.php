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
    
    public function voice()
    {
        zray_disable();
        return \View::make('default.voicetest');
    }

	public function index()
	{
	    $sections = [
    	    'fullscreen_above' => '',
    	    'fullscreen_below' => '',
    	    'top_bar' => '',
    	    'top_left' => '',
    	    'top_center' => '',
    	    'top_right' => '',
	        'right_middle' => '',
	        'left_middle' => '',
    	    'upper_third' => '',
    	    'middle_center' => '',
    	    'lower_third' => '',
    	    'bottom_bar' => '',
    	    'bottom_left' => '',
    	    'bottom_center' => '',
    	    'bottom_right' => ''
	    ];
	    
	    try {
	        
    		$layoutView =  View::make('default.index', $sections);
		    
    		// Render Plugins
    		\Event::fire('cooglemirror.render', [$layoutView]);
		    
		} catch(\Exception $e) {
		    
		    try {
		        $sections['upper_third'] = View::make('default.error', [
		            'exception' => $e
		        ])->render();
		        
		    } catch(\Exception $e) {
		        $sections['middle_center'] = '<p><span class="xlarge fa fa-fw fa-bomb"></span></p><p>An error has occurred:</p><p>' . $e->getMessage() . '</p>';
		    }
		    
		    $layoutView =  View::make('default.index', $sections);
		}
		
		return $layoutView;
	}

}
