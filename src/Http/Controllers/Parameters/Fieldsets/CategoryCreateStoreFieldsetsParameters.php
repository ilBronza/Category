<?php

namespace IlBronza\Category\Http\Controllers\Parameters\Fieldsets;

use IlBronza\Form\Helpers\FieldsetsProvider\FieldsetParametersFile;

class CategoryCreateStoreFieldsetsParameters extends FieldsetParametersFile
{
    public function _getFieldsetsParameters() : array
    {
        return [
            'package' => [
                'translationPrefix' => 'category::fields',
                'fields' => [
                    'name' => ['text' => 'string|required|max:191'],
                    'slug' => ['text' => 'string|nullable|max:191|unique:categories__categories'],
                    'collection' => ['text' => 'string|nullable|max:255'],
                    'parent' => [
                        'type' => 'select',
                        'multiple' => false,
                        'rules' => 'string|max:191|nullable|exists:categories__categories,id',
                        'relation' => 'parent'
                    ]
                ],
                'width' => ['1-3@m']
            ]
        ];
    }
}
