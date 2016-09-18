<?php

namespace Dawson\TVDB;

use Illuminate\Support\ServiceProvider;

class TVDBServiceProvider extends ServiceProvider
{
	/**
	* Register bindings in the container.
	*
	* @return void
	*/
	public function register()
	{
		$this->app->bind('tvdb', function($app) {
			return new TVDB;
		});
	}

	/**
	* Perform post-registration booting of services.
	*
	* @return void
	*/
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/tvdb.php' => config_path('tvdb.php'),
		], 'config');
	}
}