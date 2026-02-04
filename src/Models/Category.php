<?php

namespace IlBronza\Category\Models;

use IlBronza\Category\Models\Traits\CategoryInteractsWithFilecabinetTrait;
use IlBronza\Category\Models\Traits\CategoryRelationsAndScopesTrait;
use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use IlBronza\CRUD\Traits\Model\CRUDParentingTrait;
use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use IlBronza\CRUD\Traits\Model\PackagedModelsTrait;

class Category extends BaseModel
{
	use PackagedModelsTrait;
	use CRUDUseUuidTrait;
	use CRUDSluggableTrait;
	use CRUDParentingTrait;

	static $packageConfigPrefix = 'category';

	use CategoryRelationsAndScopesTrait;
	use CategoryInteractsWithFilecabinetTrait;

	static $modelConfigPrefix = 'category';
	public ?string $translationFolderPrefix = 'category';
	public $deletingRelationships = ['children'];
	protected $keyType = 'string';

	public function getRelatedCategories()
	{
		return $this->children()->with('parent', 'children')->get();
	}

	public function getPdfTitle() : ? string
	{
		return $this->pdf_title;
	}

	static function provideCategoryByName(string $name) : static
	{
		if($result = static::where('name', $name)->first())
			return $result;

		$category = static::make();
		$category->name = $name;
		$category->save();

		return $category;
	}
}
