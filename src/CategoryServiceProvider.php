<?php

namespace IlBronza\Category;

use IlBronza\Category\Models\Categorizable;
use IlBronza\Category\Models\Category as CategoryModel;
use IlBronza\CRUD\Traits\IlBronzaPackages\IlBronzaServiceProviderPackagesTrait;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
	use IlBronzaServiceProviderPackagesTrait;

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot() : void
	{
		Relation::morphMap([
			'Category' => CategoryModel::getProjectClassName(),
			'Categorizable' => Categorizable::getProjectClassName(),
		]);

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'category');
		// $this->loadViewsFrom(__DIR__.'/../resources/views', 'ilbronza');
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		$this->loadRoutesFrom(__DIR__ . '/routes.php');

		// Publishing is only necessary when using the CLI.
		if ($this->app->runningInConsole())
		{
			$this->bootForConsole();
		}
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register() : void
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/category.php', 'category');

		// $this->app->make('IlBronza\Category\Http\Controllers\CrudCategoryController');

		// $this->app->make('IlBronza\Category\Http\Controllers\CrudCategoryChildrenController');

		// Register the service the package provides.
		$this->app->singleton('category', function ($app)
		{
			return new Category;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['category'];
	}

	/**
	 * Console-specific booting.
	 *
	 * @return void
	 */
	protected function bootForConsole() : void
	{
		// Publishing the configuration file.
		$this->publishes([
			__DIR__ . '/../config/category.php' => config_path('category.php'),
		], 'category.config');

		// Publishing the views.
		/*$this->publishes([
			__DIR__.'/../resources/views' => base_path('resources/views/vendor/ilbronza'),
		], 'category.views');*/

		// Publishing assets.
		/*$this->publishes([
			__DIR__.'/../resources/assets' => public_path('vendor/ilbronza'),
		], 'category.views');*/

		// Publishing the translation files.
		/*$this->publishes([
			__DIR__.'/../resources/lang' => resource_path('lang/vendor/ilbronza'),
		], 'category.views');*/

		// Registering package commands.
		// $this->commands([]);
	}
}
