<?php

// namespace IlBronza\Category\Http\Controllers;

// use IlBronza\CRUD\CRUD;
// use IlBronza\CRUD\Http\Controllers\BasePackageTrait;
// use IlBronza\CRUD\Traits\CRUDBelongsToManyTrait;
// use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
// use IlBronza\CRUD\Traits\CRUDDeleteTrait;
// use IlBronza\CRUD\Traits\CRUDDestroyTrait;
// use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;
// use IlBronza\CRUD\Traits\CRUDIndexTrait;
// use IlBronza\CRUD\Traits\CRUDNestableTrait;
// use IlBronza\CRUD\Traits\CRUDPlainIndexTrait;
// use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
// use IlBronza\CRUD\Traits\CRUDShowTrait;
// use IlBronza\CRUD\Traits\CRUDUpdateEditorTrait;
// use IlBronza\Category\Http\Controllers\CRUDTraits\CRUDCategoryParametersTrait;
// use IlBronza\Category\Models\Category;
// use IlBronza\Datatables\Datatables;
// use Illuminate\Http\Request;
// use Illuminate\Support\Collection;
// use Illuminate\Support\Str;

// class CrudCategoryController extends CRUD
// {
//     use BasePackageTrait;

//     use CRUDCategoryParametersTrait;

//     use CRUDNestableTrait;

//     use CRUDShowTrait;
//     use CRUDPlainIndexTrait;
//     use CRUDIndexTrait;
//     use CRUDEditUpdateTrait;
//     use CRUDUpdateEditorTrait;
//     use CRUDCreateStoreTrait;

//     use CRUDDeleteTrait;
//     use CRUDDestroyTrait;

//     use CRUDRelationshipTrait;
//     use CRUDBelongsToManyTrait;

//     public $configModelClassName = 'category';

//     public function getRouteBaseNamePrefix() : ? string
//     {
//         return config('category.routePrefix');
//     }

//     public function setModelClass()
//     {
//         $this->modelClass = config("category.models.{$this->configModelClassName}.class");
//     }

//     /**
//      * subject model class full path
//      **/
//     public $modelClass = Category::class;

//     /**
//      * http methods allowed. remove non existing methods to get a 403
//      **/
//     public $allowedMethods = [
//         'index',
//         'show',
//         'edit',
//         'update',
//         'create',
//         'store',
//         'destroy',
//         'reorder',
//         'storeReorder'
//     ];


//     /**
//      * getter method for 'index' method.
//      *
//      * is declared here to force the developer to rationally choose which elements to be shown
//      *
//      * @return Collection
//      **/
//     public function getIndexElements() : Collection
//     {
//         return Category::with('parent', 'children')->get();
//     }

//     /**
//      * START base methods declared in extended controller to correctly perform dependency injection
//      *
//      * these methods are compulsorily needed to execute CRUD base functions
//      **/
//     public function show(Category $category)
//     {
//         //$this->addExtraView('top', 'folder.subFolder.viewName', ['some' => $thing]);

//         return $this->_show($category);
//     }

//     public function edit(Category $category)
//     {
//         return $this->_edit($category);
//     }

//     public function update(Request $request, Category $category)
//     {
//         return $this->_update($request, $category);
//     }

//     public function destroy(Category $category)
//     {
//         return $this->_destroy($category);
//     }

//     public function reorder(Request $request, Category $category = null)
//     {
//         return $this->_reorder($request, $category);
//     }

//     /**
//      * END base methods
//      **/





// }

