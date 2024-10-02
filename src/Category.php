<?php

namespace IlBronza\Category;

use IlBronza\CRUD\Providers\RouterProvider\RoutedObjectInterface;
use IlBronza\CRUD\Traits\IlBronzaPackages\IlBronzaPackagesTrait;

class Category implements RoutedObjectInterface
{
	use IlBronzaPackagesTrait;

	static $packageConfigPrefix = 'category';

	public function manageMenuButtons()
	{
		if (! $menu = app('menu'))
			return;

		$button = $menu->provideButton([
			'text' => 'generals.settings',
			'name' => 'settings',
			'icon' => 'gear',
			'roles' => ['administrator']
		]);

		$categoryButton = $menu->createButton([
			'name' => 'categories',
			'icon' => 'folder',
			'text' => 'category::category.manage',
			'href' => app('category')->route('categories.index'),
			'children' => [
				[
					'name' => 'categories-index',
					'icon' => 'list',
					'text' => 'category::category.index',
					'href' => app('category')->route('categories.index')
				],
				[
					'name' => 'categories-reorder',
					'icon' => 'bars-staggered',
					'text' => 'category::category.reorder',
					'href' => app('category')->route('categories.reorder')
				],
				[
					'name' => 'categories-create',
					'icon' => 'plus',
					'text' => 'category::category.create',
					'href' => app('category')->route('categories.create')
				],
			]
		]);

		$button->addChild($categoryButton);
	}
}