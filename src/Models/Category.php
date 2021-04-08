<?php

namespace IlBronza\Category\Models;

use App\Models\Traits\Relationships\ParentingTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use IlBronza\CRUD\Traits\Model\CRUDModelTrait;
use IlBronza\CRUD\Traits\Model\CRUDRelationshipModelTrait;

class Category extends Model
{
    use HasFactory;

    use CRUDModelTrait;
    use CRUDRelationshipModelTrait;
    use ParentingTrait;

    public function getParentPossibleValuesArray()
    {
    	return cache()->remember(
    		'categoriesPossibleValuesArray',
    		3600,
    		function()
    		{
    	        $categories = Category::all();

    	        $result = [];

    	        foreach($categories as $category)
    	        	$result[$category->getKey()] = $category->getName();

    	        return $result;
    		}
    	);
    }

}
