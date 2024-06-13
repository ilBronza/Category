<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\CRUD;

class CategoryCRUD extends CRUD
{
    public $configModelClassName = 'category';

    public function getRouteBaseNamePrefix() : ? string
    {
        return config('category.routePrefix');
    }

    public function setModelClass()
    {
        $this->modelClass = config("category.models.{$this->configModelClassName}.class");
    }

}
