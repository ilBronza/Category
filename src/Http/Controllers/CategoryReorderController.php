<?php
namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\Traits\CRUDNestableTrait;
use IlBronza\Category\Http\Controllers\CategoryCRUD;
use IlBronza\Category\Models\Category;
use Illuminate\Http\Request;

class CategoryReorderController extends CategoryCRUD
{
    use CRUDNestableTrait;

    /**
     * http methods allowed. remove non existing methods to get a 403
     **/
    public $allowedMethods = [
        'reorder',
        'storeReorder'
    ];

    public function reorder(Request $request, Category $category = null)
    {
        return $this->_reorder($request, $category);
    }
}

