<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\Traits\CRUDIndexTrait;
use IlBronza\CRUD\Traits\CRUDPlainIndexTrait;
use IlBronza\Category\Models\Category;
use IlBronza\Vehicles\Http\Controllers\Vehicles\VehicleCRUD;

class CategoryIndexController extends CategoryCRUD
{
    use CRUDPlainIndexTrait;
    use CRUDIndexTrait;

    public $allowedMethods = ['index'];

    public function getIndexFieldsArray()
    {
        return config('category.models.category.fieldsGroupsFiles.index')::getTracedFieldsGroup();
    }

    public function addIndexButtons()
    {
        $this->table->addButton(
            Category::getReorderButton()
        );
    }

    public function getRelatedFieldsArray()
    {
        return config('category.models.category.fieldsGroupsFiles.related')::getTracedFieldsGroup();
    }

    public function getIndexElements()
    {
        return $this->getModelClass()::with('parent', 'children')->withCount('categorizables')->get();
    }

}
