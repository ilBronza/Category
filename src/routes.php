<?php

use IlBronza\Category\Facades\Category;

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' => 'categories-manager',
	'as' => config('category.routePrefix')
	],
	function()
	{
		Route::group(['prefix' => 'categories'], function()
		{
			Route::get('', [Category::getController('category', 'index'), 'index'])->name('categories.index');
			Route::get('create', [Category::getController('category', 'create'), 'create'])->name('categories.create');
			Route::post('', [Category::getController('category', 'store'), 'store'])->name('categories.store');
			Route::get('{category}', [Category::getController('category', 'show'), 'show'])->name('categories.show');
			Route::get('{category}/edit', [Category::getController('category', 'edit'), 'edit'])->name('categories.edit');
			Route::put('{category}', [Category::getController('category', 'edit'), 'update'])->name('categories.update');

			Route::delete('{category}/delete', [Category::getController('category', 'destroy'), 'destroy'])->name('categories.destroy');


			// Route::prefix('parent/{parent}')->group(function () {
			// 	Route::resource('categories', 'CrudCategoryChildrenController')->names('categories.children');
			// });
		});



		//START ROUTES PER REORDERING
		Route::get('categories-reorder/{category?}', [Category::getController('category', 'reorder'), 'reorder'])->name('categories.reorder');
		Route::post('categories-reorder', [Category::getController('category', 'reorder'), 'storeReorder'])->name('categories.storeReorder');
		//STOP ROUTES PER REORDERING

	}
);
