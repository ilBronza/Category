<?php

namespace IlBronza\Category\Helpers;

use IlBronza\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class CategoryExtractorHelper
{
	public Category $category;
	public Category $tree;

	abstract public static function parseCategory(Category $category, array $categorizablesTypes) : Collection;

	public function setCategory(Category|string $category)
	{
		if (! $category instanceof Model)
			$category = Category::getProjectClassName()::findOrFail($category);

		$this->category = $category;
	}

	public function getCategory() : Category
	{
		return $this->category;
	}

	public function getCategoryKey() : string
	{
		return $this->getCategory()->getKey();
	}

	public function setCategorizableTypes(array $categorizablesTypes = null)
	{
		$this->categorizablesTypes = Category::getProjectClassName()::setCorrectCategorizablesTypes($categorizablesTypes);
	}

	public function getCategoriZablesTypes() : array
	{
		return $this->categorizablesTypes;
	}

	public function setTree() : static
	{
		$this->tree = Category::getProjectClassName()::with(
			$this->getCategorizablesTypes()
		)->withCategorizables(
			$this->getCategorizablesTypes()
		)->findOrFail(
			$this->getCategoryKey()
		);

		return $this;
	}

	public function getTree() : Category
	{
		return $this->tree;
	}

	static function createByCategoryAndCategorizablesTypes(Category|string $category, array $categorizablesTypes = null) : static
	{
		$helper = new static();

		$helper->setCategory($category);
		$helper->setCategorizableTypes($categorizablesTypes);

		return $helper;
	}

	/**
	 * Get categorizables of a category, categories are recursive and each
	 * one can have many elements of different types
	 *
	 * if you want to get all categorizables set $categorizablesTypes as null
	 * and you will get $category->categorizables as a collection
	 * made by single $categorizable elements
	 *
	 * Category
	 *  - - recursiveChildren
	 *  - - - category
	 *  - - - category
	 *  - - - - categorizable.categorizable //Form
	 *  - - - - categorizable.categorizable //Description
	 *  - - - - categorizable.categorizable //Form
	 *
	 *
	 * if you want to get specific relations you can populate $categoriesTypes
	 * and you will get separate collections for each relation
	 *
	 * Category
	 *  - - recursiveChildren
	 *  - - - category
	 *  - - - - forms //Collection
	 *  - - - - descriptions //Collection
	 *  - - - category
	 *
	 *
	 * @param  Category|string  $category
	 * @param  array|null       $categorizablesTypes
	 *
	 * @return Collection
	 */
	public static function getRecursiveCategorizables(Category|string $category, array $categorizablesTypes = null) : Category
	{
		$helper = static::createByCategoryAndCategorizablesTypes($category, $categorizablesTypes);

		return $helper->setTree()->getTree();
	}

	public static function extractRelatedElements(Category $category, string $categorizableType) : Collection
	{
		if (strpos($categorizableType, ".") !== false)
		{
			$pieces = explode('.', $categorizableType);

			$pivotElementRelation = $pieces[0];
			$destinationElementRelation = $pieces[1];

			return $category->$pivotElementRelation->pluck($destinationElementRelation);
		}

		return $category->$categorizableType;
	}

	public static function extractRelatedCategorizables(Category $category, array $categorizablesTypes) : Collection
	{
		$result = collect();

		foreach ($categorizablesTypes as $categorizablesType)
			$result = static::extractRelatedElements($category, $categorizablesType)->merge($result);

		return $result;
	}

	public static function extractRecursiveCategorizables(Category|string $category, array $categorizablesTypes = null)
	{
		$helper = static::createByCategoryAndCategorizablesTypes($category, $categorizablesTypes);

		$category = $helper->setTree()->getTree();

		return static::parseCategory(
			$category, $helper->getCategorizablesTypes()
		);
	}

}