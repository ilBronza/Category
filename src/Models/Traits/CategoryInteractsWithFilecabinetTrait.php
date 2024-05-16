<?php

namespace IlBronza\Category\Models\Traits;

use IlBronza\FileCabinet\Models\Form;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait CategoryInteractsWithFilecabinetTrait
{
    public function directForms()
    {
        return $this->hasMany(
            Form::getProjectClassName()
        );
    }

    public function forms() : MorphToMany
    {
        return $this->morphedByCategory(Form::getProjectClassName());
    }


    
}
