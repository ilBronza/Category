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
        if(! $menu = app('menu'))
            return;

        $button = $menu->provideButton([
                'text' => 'generals.settings',
                'name' => 'settings',
                'icon' => 'gear',
                'roles' => ['administrator']
            ]);

        $categoryButton = $menu->createButton([
            'name' => 'categories',
            'icon' => 'box-archive',
            'text' => 'categories.manage',
            'href' => app('category')->route('categories.index'),
            'children' => [
                [
                    'name' => 'categories-reorder',
                    'icon' => 'box-archive',
                    'text' => 'categories.reorder',
                    'href' => app('category')->route('categories.reorder')
                ]
            ]
        ]);

        $button->addChild($categoryButton);
	}
}