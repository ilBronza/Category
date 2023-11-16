<?php

namespace IlBronza\Category\Traits;

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

	public function categories()
	{
		return $this->morphToMany(
			$this->getCategoryModel(),
			'categorizable'
		);
	}

	public function getPossibleCategoriesValuesArray()
	{
		$nameField = $this->getCategoryModel()::getNameFieldName();
		$keyField = $this->getCategoryModel()::make()->getKeyName();

		$result = $this->getCategoryModel()::collection(
						$this->getCategoriesCollection()
					)
					->select($nameField, $keyField)
					->get();

		return $result->pluck(
			$nameField,
			$keyField
		)->toArray();
	}

}