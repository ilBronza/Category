<?php

namespace IlBronza\Category\Models\Traits;

use IlBronza\Category\Models\Categorizable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait CategoryRelationsAndScopesTrait
{
    /**
     * generic morphing function for category elements
     * you have to pass only the model class and the system
     * create the morphedByMany correct parameters
     * 
     * @param string $model
     * @return MorphToMany
     */
    public function morphedByCategory(string $model) : MorphToMany
    {
        return $this->morphedByMany(
            $model,
            'categorizable',
            config('category.models.categorizable.table')
        )->using(Categorizable::getProjectClassName());
    }

    /** return categorizables related to this category
     *
     *  @return MorphToMany
     **/
    public function categorizables()
    {
        return $this->hasMany(
            Categorizable::getProjectClassName()
        );
    }

    static function setCorrectCategorizablesTypes(array $categorizablesTypes = null) : array
    {
        if(! $categorizablesTypes)
            return ['categorizables.categorizable'];

        return $categorizablesTypes;
    }

    public function scopeWithCategorizables($query, array $categorizablesTypes = null)
    {
        $categorizablesTypes = static::setCorrectCategorizablesTypes($categorizablesTypes);

        $query->with(['recursiveChildren' => function($_query) use ($categorizablesTypes)
        {
            $_query->with($categorizablesTypes);

            $_query->getQuery()->withCategorizables();
        }]);
    }

    public function scopeCollection($query, string $collection = null)
    {
        if($collection)
            $query->where('collection', $collection);

        return $query;
    }
}
