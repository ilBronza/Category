<?php

namespace ilBronza\Category\Http\Controllers;

use IlBronza\Category\Http\Controllers\CRUDTraits\CRUDCategoryParametersTrait;
use IlBronza\Category\Models\Category;
use IlBronza\Datatables\Datatables;
use Illuminate\Http\Request;
use ilBronza\CRUD\CRUD;
use ilBronza\CRUD\Traits\CRUDBelongsToManyTrait;
use ilBronza\CRUD\Traits\CRUDCreateStoreTrait;
use ilBronza\CRUD\Traits\CRUDDeleteTrait;
use ilBronza\CRUD\Traits\CRUDDestroyTrait;
use ilBronza\CRUD\Traits\CRUDEditUpdateTrait;
use ilBronza\CRUD\Traits\CRUDIndexTrait;
use ilBronza\CRUD\Traits\CRUDPlainIndexTrait;
use ilBronza\CRUD\Traits\CRUDRelationshipTrait;
use ilBronza\CRUD\Traits\CRUDShowTrait;
use ilBronza\CRUD\Traits\CRUDUpdateEditorTrait;

class CrudCategoryController extends CRUD
{
    use CRUDCategoryParametersTrait;

    use CRUDShowTrait;
    use CRUDPlainIndexTrait;
    use CRUDIndexTrait;
    use CRUDEditUpdateTrait;
    use CRUDUpdateEditorTrait;
    use CRUDCreateStoreTrait;

    use CRUDDeleteTrait;
    use CRUDDestroyTrait;

    use CRUDRelationshipTrait;
    use CRUDBelongsToManyTrait;

    /**
     * subject model class full path
     **/
    public $modelClass = Category::class;

    /**
     * http methods allowed. remove non existing methods to get a 403 when called by routes
     **/
    public $allowedMethods = [
        'index',
        'show',
        'edit',
        'update',
        'create',
        'store',
        'destroy',
        'reorder',
        'stroreReorder'
    ];

    /**
     * to override show view use full view name
     **/
    //public $showView = 'products.showPartial';

    // public $guardedEditDBFields = ['id', 'created_at', 'updated_at', 'deleted_at'];
    // public $guardedCreateDBFields = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $guardedShowDBFields = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public $showMethodRelationships = ['children'];

    protected $relationshipsControllers = [
        'children' => '\IlBronza\Category\Http\Controllers\CrudCategoryController'
    ];

    /**
     * relations called to be automatically shown on 'show' method
     **/
    //public $showMethodRelationships = ['posts', 'users', 'operations'];

    /**
        protected $relationshipsControllers = [
        'permissions' => '\IlBronza\AccountManager\Http\Controllers\PermissionController'
    ];
    **/


    /**
     * getter method for 'index' method.
     *
     * is declared here to force the developer to rationally choose which elements to be shown
     *
     * @return Collection
     **/
    public function getIndexElements()
    {
        return Category::with('parent', 'children')->get();
    }

    public function reorder(Request $request)
    {
        $elements = $this->getIndexElements();

        $action = route('categories.stroreReorder');

        return view('crud::reorder', compact('elements', 'action'));
    }

    public function stroreReorder(Request $request)
    {
        
    }

    /**
     * START base methods declared in extended controller to correctly perform dependency injection
     *
     * these methods are compulsorily needed to execute CRUD base functions
     **/
    public function show(Category $category)
    {
        //$this->addExtraView('top', 'folder.subFolder.viewName', ['some' => $thing]);

        return $this->_show($category);
    }

    public function edit(Category $category)
    {
        return $this->_edit($category);
    }

    public function update(Request $request, Category $category)
    {
        return $this->_update($request, $category);
    }

    public function destroy(Category $category)
    {
        return $this->_destroy($category);
    }

    /**
     * END base methods
     **/




     /**
      * START CREATE PARAMETERS AND METHODS
      **/

    // public function beforeRenderCreate()
    // {
    //     $this->modelInstance->agent_id = session('agent')->getKey();
    // }

     /**
      * STOP CREATE PARAMETERS AND METHODS
      **/

}

