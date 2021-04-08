<?php

namespace ilBronza\Category\Http\Controllers\CRUDTraits;

trait CRUDCategoryChildParametersTrait
{
    public static $tables = [

        'index' => [
            'fields' => 
            [
                'mySelfPrimary' => 'primary',
                'mySelfEdit' => 'links.edit',
                'mySelfSee' => 'links.see',
                'name' => 'flat',
                'slug' => 'flat',
                'parent.name' => 'flat',
                'children' => [
                    'type' => 'relations.hasMany',
                    'routeBasename' => 'categories'
                ]
            ]
        ]
    ];

    static $formFields = [
        'common' => [
            'default' => [
                'name' => ['text' => 'string|required|max:191'],
                'slug' => ['text' => 'string|required|max:191|unique:categories']
            ]
        ]
    ];    
}