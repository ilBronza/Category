<?php

namespace IlBronza\Category\Http\Controllers\Parameters\RelationshipsManagers;

use IlBronza\CRUD\Providers\RelationshipsManager\RelationshipsManager;

class CategoryRelationManager Extends RelationshipsManager
{
	public  function getAllRelationsParameters() : array
	{
		return [
			'show' => [
				'relations' => [
					'children' => [
						'controller' => config('category.models.category.controllers.index'),
						'elementGetterMethod' => 'getRelatedCategories'
					],
				]
			]
		];
	}
}