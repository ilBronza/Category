<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\Traits\CRUDDeleteTrait;

class CategoryDestroyController extends CategoryCRUD
{
    use CRUDDeleteTrait;

    public $allowedMethods = ['destroy'];

    public function destroy($category)
    {
        $category = $this->findModel($category);

        return $this->_destroy($category);
    }
}