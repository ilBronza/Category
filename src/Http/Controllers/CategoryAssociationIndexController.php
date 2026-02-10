<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\Category\Http\Controllers\CategoryIndexController;

class CategoryAssociationIndexController extends CategoryIndexController
{
    public $avoidCreateButton = true;

    public function addIndexButtons()
    {
    }

    public function getIndexFieldsArray()
    {
        return config('category.models.category.fieldsGroupsFiles.associate')::getTracedFieldsGroup();
    }

    public function getIndexElements()
    {
        return $this->getModelClass()::with('parent', 'children')->withCount('categorizables')->get();
    }

}
