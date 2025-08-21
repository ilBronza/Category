<?php

namespace IlBronza\Category\Traits;

use IlBronza\Category\Models\Categorizable;
use IlBronza\Category\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

use function is_array;
use function is_string;

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

	public function getCategories() : Collection
	{
		return $this->categories;
	}

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

	public function getCategory() : ? Category
	{
		return $this->category;
	}

	public function categorizables() : MorphMany
	{
		return $this->morphMany(
			Categorizable::getProjectClassName(),
			'categorizable'
		);
	}

	public function hasDirectCategory(Category|string $category) : bool
	{
		if(is_string($category))
			return $this->category_id == $category;

		return $this->category_id == $category->getKey();
	}

	public function scopeByCategory($query, string|Category $category)
	{
		if(! is_string($category))
			$category = $category->getKey();

		$query->where('category_id', $category);
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

	public function scopeExceptGeneralCategory($query, string|Category $category)
	{
		if(! is_string($category))
			$category = $category->getKey();

		return $query->whereDoesntHave('categorizables', function($query) use($category)
		{
			$query->where('category_id', $category);
		});
	}

	public function scopeByGeneralCategories($query, Collection $categories)
	{
		return $query->byGeneralCategoriesIds($categories->pluck('id'));
	}

	public function scopeByGeneralCategoriesIds($query, array|Collection $cagegoriesIds)
	{
		return $query->whereHas('categorizables', function($query) use($cagegoriesIds)
		{
			$query->whereIn('category_id', $cagegoriesIds);
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

	static function getByDirectCategory(Category $category) : Collection
	{
		return static::where('category_id', $category->getKey())->orderBy('sorting_index')->get();
	}
}