<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;
use Illuminate\Http\Request;

class CategoryEditUpdateController extends CategoryCRUD
{
    use CRUDEditUpdateTrait;

    public $allowedMethods = ['edit', 'update'];

    public function getGenericParametersFile() : ? string
    {
        return config('category.models.category.parametersFiles.create');
    }

    public function edit(string $category)
    {
        $category = $this->findModel($category);

        return $this->_edit($category);
    }

    public function update(Request $request, $category)
    {
        $category = $this->findModel($category);

        return $this->_update($request, $category);
    }
}
