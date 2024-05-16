<?php

use IlBronza\Category\Http\Controllers\CrudCategoryController;
use IlBronza\Category\Models\Categorizable;
use IlBronza\Category\Models\Category;

return [
    'routePrefix' => 'ibCategory',

    'models' => [
        'category' => [
            'class' => Category::class,
            'table' => 'categories__categories',
            // 'fieldsGroupsFiles' => [
            //     'index' => FormFieldsGroupParametersFile::class
            // ],
            // 'parametersFiles' => [
            //     'create' => FormCreateStoreFieldsetsParameters::class,
            //     'show' => FormShowFieldsetsParameters::class
            // ],
            // 'relationshipsManagerClasses' => [
            //     'show' => FormRelationManager::class
            // ],
            'controllers' => [
                'crud' => CrudCategoryController::class,

                // 'index' => FormIndexController::class,
                // 'create' => FormCreateStoreController::class,
                // 'store' => FormCreateStoreController::class,
                // 'show' => FormShowController::class,
                // 'edit' => FormEditUpdateController::class,
                // 'update' => FormEditUpdateController::class,
                // 'destroy' => FormDestroyController::class,
            ]
        ],
        'categorizable' => [
            'table' => 'categories__categorizables',
            'class' => Categorizable::class,
        ],
    ]
];