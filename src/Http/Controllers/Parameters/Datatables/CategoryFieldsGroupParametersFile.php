<?php

namespace IlBronza\Category\Http\Controllers\Parameters\Datatables;

use IlBronza\Datatables\Providers\FieldsGroupParametersFile;

class CategoryFieldsGroupParametersFile extends FieldsGroupParametersFile
{
	static function getFieldsGroup() : array
	{
		return [
            'translationPrefix' => 'filecabinet::fields',
            'fields' => 
            [
                'mySelfPrimary' => 'primary',
                'mySelfEdit' => 'links.edit',
                'mySelfSee' => 'links.see',
//                'mySelfLink' => 'links.clone',

                'name' => 'flat',
                'slug' => 'flat',
                'parent' => 'relations.belongsTo',
                'children' => 'relations.hasMany',
                'categorizables_count' => 'flat',
                'mySelfDelete' => 'links.delete'
            ]
        ];
	}
}