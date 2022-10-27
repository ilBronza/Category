<?php

namespace IlBronza\Category\Models;

use IlBronza\CRUD\Models\SluggableBaseModel;
use IlBronza\CRUD\Traits\Model\CRUDParentingTrait;

class Category extends SluggableBaseModel
{
    use CRUDParentingTrait;

    static $parentKeyName = 'parent_slug';

    protected  $fillable = ['name', 'slug', 'parent_slug'];

    public $deletingRelationships = ['children'];

    public function scopeCollection($query, string $collection = null)
    {
    	if($collection)
    		$query->where('collection', $collection);

    	return $query;
    }
}
