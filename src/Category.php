<?php

namespace IlBronza\Category;

class Category
{
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
            'href' => route('categories.index'),
            'children' => [
                [
                    'name' => 'categories-reorder',
                    'icon' => 'box-archive',
                    'text' => 'categories.reorder',
                    'href' => route('categories.reorder')
                ]
            ]
        ]);

        $button->addChild($categoryButton);
	}
}