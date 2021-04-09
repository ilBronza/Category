<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\Category\Http\Controllers\CRUDTraits\CRUDCategoryParametersTrait;
use IlBronza\Category\Models\Category;
use Illuminate\Http\Request;
use IlBronza\CRUD\CRUD;
use IlBronza\CRUD\Traits\CRUDBelongsToManyTrait;
use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDDeleteTrait;
use IlBronza\CRUD\Traits\CRUDDestroyTrait;
use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;
use IlBronza\CRUD\Traits\CRUDIndexTrait;
use IlBronza\CRUD\Traits\CRUDPlainIndexTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
use IlBronza\CRUD\Traits\CRUDShowTrait;
use IlBronza\CRUD\Traits\CRUDUpdateEditorTrait;
use IlBronza\Datatables\Datatables;

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
        // $elements = $this->getIndexElements();
        $elements = Category::all();
        // dd($elements);
        $elements = $this->parseTree($elements);

        $action = route('categories.stroreReorder');

        return view('crud::reorder', compact('elements', 'action'));
    }

    //https://stackoverflow.com/questions/2915748/convert-a-series-of-parent-child-relationships-into-a-hierarchical-tree
    function parseTree($tree, $parent_id = null) {
        $return = collect();
        # Traverse the tree and search for direct children of the root
        foreach($tree as $id => $element) {
            # A direct child is found
            if($element->parent_id == $parent_id) {
                # Remove item from tree (we don't need to traverse this again)
                // unset($tree[$id]);
                $tree->forget($id);
                # Append the child into result array and parse its children
                $element->children = $this->parseTree($tree, $element->getKey());
                $return->push($element);
            }
        }

        return $return;    
    }

    function printTree($tree) {
        if(!is_null($tree) && count($tree) > 0) {
            echo '<ul>';
            foreach($tree as $node) {
                /*$return .= '<div class="uk-margin">
                    <div class="uk-card uk-card-default uk-card-body uk-card-small">
                        <span class="uk-sortable-handle uk-margin-small-right" uk-icon="icon: table"></span> '. $node['name'] .'
                    </div>
                </div>';*/
                echo '<li>'.$node['name'];
                printTree($node['children']);
                echo '</li>';
            }
            echo '</ul>';
        }
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

