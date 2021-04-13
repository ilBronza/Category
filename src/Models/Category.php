<?php

namespace IlBronza\Category\Models;

use App\Models\Traits\Relationships\ParentingTrait;
use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use IlBronza\CRUD\Traits\Model\CRUDModelTrait;
use IlBronza\CRUD\Traits\Model\CRUDRelationshipModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    use CRUDSluggableTrait;

    use CRUDModelTrait;
    use CRUDRelationshipModelTrait;
    use ParentingTrait;

    protected  $fillable= [ 'name', 'slug', 'parent_id'];

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
