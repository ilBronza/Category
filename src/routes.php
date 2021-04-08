<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' => 'categories-manager',
	'namespace' => 'ilBronza\Category\Http\Controllers'
	],
	function()
	{
		Route::resource('categories', 'CrudCategoryController');

		//START ROUTES PER REORDERING
		Route::get('categories-reorder', 'CrudCategoryController@reorder')->name('categories.reorder');
		Route::post('categories-reorder', 'CrudCategoryController@stroreReorder')->name('categories.stroreReorder');
		//STOP ROUTES PER REORDERING

		Route::prefix('parent/{parent}')->group(function () {
			Route::resource('categories', 'CrudCategoryChildrenController')->names('categories.children');
		});
	}
);



// Route::get('asdasad', 'asdcontroller@masd')->name('categories.children.create');

