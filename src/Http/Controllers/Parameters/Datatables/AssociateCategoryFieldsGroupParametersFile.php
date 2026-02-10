<?php

namespace IlBronza\Category\Http\Controllers\Parameters\Datatables;

use IlBronza\Datatables\Providers\FieldsGroupParametersFile;

class AssociateCategoryFieldsGroupParametersFile extends FieldsGroupParametersFile
{
	static function getFieldsGroup() : array
	{
		return [
            'translationPrefix' => 'filecabinet::fields',
            'fields' => 
            [
                'name' => 'flat',
                'slug' => 'flat',
                'parent' => 'relations.belongsTo',
                'children' => 'relations.hasMany',

                // 'mySelfAddToDelivery' => 'warehouse::deliveries.addOrders',

                'mySelfAddToCategory' => 'category::categories.addTo',
                // 'mySelfRemoveFromCategory' => 'category::categories.removeFrom',

                'categorizables_count' => 'flat',
            ]
        ];
	}
}