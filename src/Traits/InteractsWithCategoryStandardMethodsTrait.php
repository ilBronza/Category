<?php

namespace IlBronza\Category\Traits;

trait InteractsWithCategoryStandardMethodsTrait
{
	public function getCategoryModel() : string
	{
		return config('category.models.category.class');
	}

	public function getCategoriesCollection() : ? string
	{
		return null;
	}

}