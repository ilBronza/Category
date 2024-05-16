<?php

namespace IlBronza\Category\Helpers;

use IlBronza\Category\Helpers\CategoryExtractorHelper;
use IlBronza\Category\Models\Category;
use Illuminate\Support\Collection;

class FlattenedCategoryExtractorHelper extends CategoryExtractorHelper
{
    public static function extractChildrenRelatedCategorizables(Collection $children, array $categorizablesTypes) : Collection
    {
        $result = collect();

        foreach($children as $child)
            $result = $result->merge(
                static::parseCategory(
                    $child,
                    $categorizablesTypes
                )
            );

        return $result;
    }

    public static function parseCategory(Category $category, array $categorizablesTypes) : Collection
    {
        $result = static::extractRelatedCategorizables(
            $category,
            $categorizablesTypes
        );

        $result = $result->merge(
            static::extractChildrenRelatedCategorizables(
                $category->getRecursiveChildren(),
                $categorizablesTypes
            )
        );

		$result->unique();

        return $result;
    }
}