<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use IlBronza\CRUD\BelongsToCRUDController;
use IlBronza\CRUD\Traits\CRUDBelongsToManyTrait;
use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDDeleteTrait;
use IlBronza\CRUD\Traits\CRUDDestroyTrait;
use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;
use IlBronza\CRUD\Traits\CRUDIndexTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
use IlBronza\CRUD\Traits\CRUDShowTrait;
use IlBronza\Category\Http\Controllers\CRUDTraits\CRUDCategoryChildParametersTrait;

class CrudCategoryChildrenController extends BelongsToCRUDController
{
    use CRUDCategoryChildParametersTrait;

    use CRUDShowTrait;
    use CRUDIndexTrait;
    use CRUDEditUpdateTrait;
    use CRUDCreateStoreTrait;

    use CRUDDeleteTrait;
    use CRUDDestroyTrait;

    use CRUDRelationshipTrait;
    use CRUDBelongsToManyTrait;

    public $parentModelClass = Category::class;
    public $modelClass = Category::class;

    public $allowedMethods = [
        'index',
        'create',
        'store',
        'delete'
    ];

    public $routeBaseNamePieces = ['categories', 'children'];
    public $parentModelKey = 'parent_id';


    //this is needed to override routename ex contacts.buildings.store => buildings.store
    // public $routeBaseNamePieces = ['buildings'];


    // public $guardedEditDBFields = ['id', 'created_at', 'updated_at', 'deleted_at'];
    // public $guardedCreateDBFields = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $guardedShowDBFields = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function index(Request $request, Category $category)
    {
        return $this->_index($request);
    }

    public function getIndexElements()
    {
        return $this->parentModel->children()->get();
    }

    public function show(Category $parent, Category $category)
    {
        return $this->_show($category);
    }

    public function store(Request $request, Category $category)
    {
        return $this->_store($request);
    }

    public function delete(Category $parent, Category $category)
    {
        return $this->_delete($category);
    }
}
