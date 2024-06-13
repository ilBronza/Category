<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
use IlBronza\CRUD\Traits\CRUDShowTrait;

class CategoryCreateStoreController extends CategoryCRUD
{
    use CRUDCreateStoreTrait;
    use CRUDShowTrait;
    use CRUDRelationshipTrait;

    public $allowedMethods = ['create', 'store'];

    public function getGenericParametersFile() : ? string
    {
        return config('category.models.category.parametersFiles.create');
    }

    public function getRelationshipsManagerClass()
    {
        return config("category.models.{$this->configModelClassName}.relationshipsManagerClasses.show");
    }

    public function show(string $category)
    {
        $category = $this->findModel($category);

        return $this->_show($category);
    }
}
