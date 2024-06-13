<?php

use IlBronza\Category\Http\Controllers\CategoryCreateStoreController;
use IlBronza\Category\Http\Controllers\CategoryDestroyController;
use IlBronza\Category\Http\Controllers\CategoryEditUpdateController;
use IlBronza\Category\Http\Controllers\CategoryIndexController;
use IlBronza\Category\Http\Controllers\CategoryShowController;
use IlBronza\Category\Http\Controllers\CrudCategoryController;
use IlBronza\Category\Http\Controllers\Parameters\Datatables\CategoryFieldsGroupParametersFile;
use IlBronza\Category\Http\Controllers\Parameters\Fieldsets\CategoryCreateStoreFieldsetsParameters;
use IlBronza\Category\Http\Controllers\Parameters\RelationshipsManagers\CategoryRelationManager;
use IlBronza\Category\Models\Categorizable;
use IlBronza\Category\Models\Category;

return [
    'routePrefix' => 'ibCategory',

    'models' => [
        'category' => [
            'class' => Category::class,
            'table' => 'categories__categories',
            'fieldsGroupsFiles' => [
                'index' => CategoryFieldsGroupParametersFile::class,
                'related' => CategoryFieldsGroupParametersFile::class
            ],
            'parametersFiles' => [
                'create' => CategoryCreateStoreFieldsetsParameters::class,
                'show' => CategoryCreateStoreFieldsetsParameters::class
            ],
            'relationshipsManagerClasses' => [
                'show' => CategoryRelationManager::class
            ],
            'controllers' => [
                'crud' => CrudCategoryController::class,

                'index' => CategoryIndexController::class,
                'create' => CategoryCreateStoreController::class,
                'store' => CategoryCreateStoreController::class,
                'show' => CategoryShowController::class,
                'edit' => CategoryEditUpdateController::class,
                'update' => CategoryEditUpdateController::class,
                'destroy' => CategoryDestroyController::class,
            ]
        ],
        'categorizable' => [
            'table' => 'categories__categorizables',
            'class' => Categorizable::class,
        ],
    ]
];