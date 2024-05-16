<?php

namespace IlBronza\Category\Helpers;

use IlBronza\Category\Models\Category;
use IlBronza\FileCabinet\Helpers\FilecabinetNodeCollection;
use Illuminate\Support\Collection;

class HierarchicalCategoryExtractorHelper extends CategoryExtractorHelper
{
    public static function parseCategory(Category $category, array $categorizablesTypes) : Collection
    {
        $filecabinetNode = new FilecabinetNodeCollection();

        $filecabinetNode->setFormElements(
            static::extractRelatedCategorizables(
                $category,
                $categorizablesTypes
            )
        );

        $filecabinetNode->setCategory($category);

        $childrenCategories = collect();

        foreach($category->getRecursiveChildren() as $child)
            $childrenCategories->push(
                static::parseCategory($child, $categorizablesTypes)
            );

        $filecabinetNode->setChildrenCategories(
            $childrenCategories
        );

        return $filecabinetNode;
    }
}