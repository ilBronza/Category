<?php

namespace IlBronza\Category\Traits;

use IlBronza\Category\Models\Categorizable;
use IlBronza\Category\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithCategoryTrait
{
	/**
	 * retrieve model category class name
	 * 
	 * questo serve per sapere che model category usare,
	 * se voglio avere category diverse
	 * a seconda delle entità per le quali servono
	 * 
	 * 
	 * public function getCategoryModel()
	 * {
	 * 	return config('filecabinet.categories.model');
	 * 	return Category::class;
	 * }
	 *
	 * @return string
	*/
	abstract public function getCategoryModel() : string ;

	/**
	 * retrieve category collection name
	 * public function getCategoriesCollection()
	 * {
	 * 
	 * 	return config('filecabinet.categories.collection');
	 * 	return 'filecabinet'
	 * }
	 *
	 * @return string
	*/
	abstract public function getCategoriesCollection() : ? string ;

	public function categories() : MorphToMany
	{
		return $this->morphToMany(
			$this->getCategoryModel(),
			'categorizable',
			config('category.models.categorizable.table'),
		)->using(Categorizable::getProjectClassName());
	}

	public function category() : BelongsTo
	{
		return $this->belongsTo(
			$this->getCategoryModel()
		);
	}

	public function categorizables() : MorphMany
	{
		return $this->morphMany(
			Categorizable::getProjectClassName(),
			'categorizable'
		);
	}

	public function scopeByGeneralCategory($query, string|Category $category)
	{
		if(! is_string($category))
			$category = $category->getKey();

		return $query->whereHas('categorizables', function($query) use($category)
		{
			$query->where('category_id', $category);
		});
	}

	public function getRecursiveChildrenArray(Category $category, int $level = 0) : array
	{
		$result = [];

		$levelString = $level ? '+-' : '';

		for($i = 1; $i < $level; $i ++)
			$levelString .= '--';

		$result[$category->getKey()] = $levelString . $category->getName();

		foreach($category->getRecursiveChildren() as $_category)
			$result = $result + $this->getRecursiveChildrenArray($_category, $level + 1);

		return $result;
	}

	public function getPossibleCategoriesValuesArray() : array
	{
		$categoryTree = Category::getProjectClassName()::staticGetTree();

		$result = [];

		foreach($categoryTree as $category)
			$result = $result + $this->getRecursiveChildrenArray($category);

		return $result;
	}

}