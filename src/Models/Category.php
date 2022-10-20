<?php

namespace IlBronza\Category\Models;

use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use IlBronza\CRUD\Traits\Model\CRUDParentingTrait;

class Category extends BaseModel
{
    use CRUDParentingTrait;
    use CRUDSluggableTrait;

    protected  $fillable= [ 'name', 'slug', 'parent_id'];

    public $deletingRelationships = ['children'];

}
