<?php

namespace IlBronza\Category\Models;

use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use IlBronza\CRUD\Traits\Model\PackagedModelsTrait;
use IlBronza\Category\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Categorizable extends MorphPivot
{
    use PackagedModelsTrait;
    use CRUDUseUuidTrait;

    static $packageConfigPrefix = 'category';
    public ? string $translationFolderPrefix = 'category';

    static $modelConfigPrefix = 'categorizable';
    public $deletingRelationships = [];

    public function category()
    {
        return $this->belongsTo(
            Category::getProjectClassName()
        );
    }

    public function categorizable()
    {
        return $this->morphTo();
    }
}
