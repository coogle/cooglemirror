<?php namespace Cooglemirror\Headlines;

use Illuminate\Support\ServiceProvider;

class HeadlinesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('cooglemirror/headlines', 'cooglemirror-headlines');
		
		\Event::listen('cooglemirror.render', function($layoutView) {
		    
		    \View::composer('cooglemirror-headlines::widget', 'Cooglemirror\Headlines\Widget');
		    
		    $view = \View::make('cooglemirror-headlines::widget')->render();
		    $layoutView->with(\Config::get('cooglemirror-headlines::widget.placement'), $view);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
