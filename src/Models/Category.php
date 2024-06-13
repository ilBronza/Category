<?php

namespace IlBronza\Category\Models;

use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use IlBronza\CRUD\Traits\Model\CRUDParentingTrait;
use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use IlBronza\CRUD\Traits\Model\PackagedModelsTrait;
use IlBronza\Category\Models\Traits\CategoryInteractsWithFilecabinetTrait;
use IlBronza\Category\Models\Traits\CategoryRelationsAndScopesTrait;

class Category extends BaseModel
{
    use PackagedModelsTrait;
    // use CRUDUseUuidTrait;
    use CRUDSluggableTrait;
    use CRUDParentingTrait;

    use CategoryRelationsAndScopesTrait;
    use CategoryInteractsWithFilecabinetTrait;

    static $packageConfigPrefix = 'category';
    public ? string $translationFolderPrefix = 'category';

    static $modelConfigPrefix = 'category';
    public $deletingRelationships = ['children'];


    public function getRelatedCategories()
    {
        return $this->children()->with('parent', 'children')->get();
    }










}
