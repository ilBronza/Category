<?php

namespace IlBronza\Category\Models;

use IlBronza\Buttons\Button;
use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use IlBronza\CRUD\Traits\Model\PackagedModelsTrait;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Categorizable extends MorphPivot
{
	use PackagedModelsTrait;
	use CRUDUseUuidTrait;

	static $packageConfigPrefix = 'category';
	static $modelConfigPrefix = 'categorizable';
	public ?string $translationFolderPrefix = 'category';
	public $deletingRelationships = [];
	protected $keyType = 'string';

	public function category()
	{
		return $this->belongsTo(
			Category::getProjectClassName()
		);
	}

	public function categorizable()
	{
		return $this->morphTo();
	}

	public function getReorderButton() : Button
	{
		return Button::create([
			'name' => 'categories-reorder',
			'icon' => 'box-archive',
			'text' => 'categories::categories.reorder',
			'href' => app('category')->route('categories.reorder')
		]);
	}

}
