<?php
namespace ITB\LEC\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LECServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 * @param Router $router
	 */
	public function boot( Router $router )
	{
		$this->loadTranslationsFrom( realpath( __DIR__ . '/../../resources/lang' ), 'LEC' );
		$this->loadViewsFrom( realpath( __DIR__ . '/../../resources/views' ), 'LEC' );
		$router->group( [
			'prefix'    => config( 'LEC.route_prefix', 'confirm' ),
			'namespace' => 'ITB\\LEC\\Controllers',
		], function ()
		{
			if ( !$this->app->routesAreCached() )
			{
				require __DIR__ . '/../routes.php';
			}
		} );
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom( __DIR__ . '/../../config/LEC.php', 'LEC' );
		$this->registerResources();
	}

	/**
	 * @return void
	 */
	protected function registerResources()
	{
		$this->publishes( [
			realpath( __DIR__ . '/../../config/LEC.php' ) => config_path( 'LEC.php' ),
		], 'config' );
		$this->publishes( [
			realpath( __DIR__ . '/../../database/migrations/' ) => database_path( 'migrations' ),
		], 'migrations' );
		$this->publishes( [
			realpath( __DIR__ . '/../../resources/views/' ) => resource_path( 'views' ),
		], 'views' );
		$this->publishes( [
			realpath( __DIR__ . '/../../resources/lang/' ) => resource_path( 'lang' ),
		], 'lang' );
	}
}
