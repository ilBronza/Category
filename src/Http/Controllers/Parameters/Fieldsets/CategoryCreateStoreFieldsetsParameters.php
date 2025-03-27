<?php

namespace IlBronza\Category\Http\Controllers\Parameters\Fieldsets;

use IlBronza\Form\Helpers\FieldsetsProvider\FieldsetParametersFile;

use function config;

class CategoryCreateStoreFieldsetsParameters extends FieldsetParametersFile
{
    public function _getFieldsetsParameters() : array
    {
        $result = [
            'base' => [
                'translationPrefix' => 'category::fields',
                'fields' => [
                    'name' => ['text' => 'string|required|max:191'],
	                $this->getModel()->getSlugField() => ['text' => 'string|nullable|max:191'],
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


	    if(config('filecabinet.enabled'))
		    $result['pdfSettings'] = [
			    'translationPrefix' => 'filecabinet::fields',
			    'fields' => [
				    'pdf_title' => ['textarea' => 'string|nullable|max:255'],
				    'pdf_description' => ['texteditor' => 'string|nullable|max:2048|'],
			    ],
			    'width' => ['1-3@m']
		    ];

		return $result;
    }
}
