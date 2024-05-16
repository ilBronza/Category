<?php

use IlBronza\Category\Facades\Category;

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' => 'categories-manager',
	'as' => config('category.routePrefix')
	],
	function()
	{
		Route::resource('categories', Category::getController('category', 'crud'));

		// Route::prefix('parent/{parent}')->group(function () {
		// 	Route::resource('categories', 'CrudCategoryChildrenController')->names('categories.children');
		// });



		//START ROUTES PER REORDERING
		Route::get('categories-reorder/{category?}', [Category::getController('category', 'crud'), 'reorder'])->name('categories.reorder');
		Route::post('categories-reorder', [Category::getController('category', 'crud'), 'storeReorder'])->name('categories.storeReorder');
		//STOP ROUTES PER REORDERING

	}
);
