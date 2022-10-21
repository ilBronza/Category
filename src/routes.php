<?php

use IlBronza\Category\Http\Controllers\CrudCategoryController;
use Illuminate\Support\Facades\Route;

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' => 'categories-manager',
	'namespace' => 'IlBronza\Category\Http\Controllers'
	],
	function()
	{
		Route::resource('categories', CrudCategoryController::class);

		Route::prefix('parent/{parent}')->group(function () {
			Route::resource('categories', 'CrudCategoryChildrenController')->names('categories.children');
		});



		//START ROUTES PER REORDERING
		Route::get('categories-reorder/{category?}', [CrudCategoryController::class, 'reorder'])->name('categories.reorder');
		Route::post('categories-reorder', [CrudCategoryController::class, 'storeReorder'])->name('categories.storeReorder');
		//STOP ROUTES PER REORDERING

	}
);



// Route::get('asdasad', 'asdcontroller@masd')->name('categories.children.create');

