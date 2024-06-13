<?php

namespace IlBronza\Category\Http\Controllers\CRUDTraits;

trait CRUDCategoryParametersTrait
{
    // public static $tables = [

    //     'index' => [
    //         'fields' => 
    //         [
    //             'mySelfPrimary' => 'primary',
    //             'mySelfEdit' => 'links.edit',
    //             'mySelfSee' => 'links.see',
    //             'name' => 'flat',
    //             'slug' => 'flat',
    //             'collection' => 'flat',
    //             'parent.name' => 'flat',
    //             'children' => 'relations.hasMany',
    //             'mySelfDelete' => 'links.delete'
    //         ]
    //     ]
    // ];

    // static $formFields = [
    //     'common' => [
    //         'default' => [
    //             'name' => ['text' => 'string|required|max:191'],
    //             'slug' => ['text' => 'string|nullable|max:191|unique:categories__categories'],
    //             'collection' => ['text' => 'string|nullable|max:255'],
    //             'parent' => [
    //                 'type' => 'select',
    //                 'multiple' => false,
    //                 'rules' => 'string|max:191|nullable|exists:categories__categories,id',
    //                 'relation' => 'parent'
    //             ]
    //         ]
    //     ]
    // ];    
}