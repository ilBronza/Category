<?php

namespace IlBronza\Category\Traits;

use IlBronza\Buttons\Button;
use IlBronza\Category\Models\Category;

trait CRUDIndexHasCategoriesTrait
{
    public function getInteractsWithCategoryButton(Category $category = null): Button
    {
        $button = Button::create([
            'href' => app('category')->route('association.index', ['category' => $category]),
            'text' => 'categories::buttons.associateToCategory',
            'icon' => 'icons'
        ]);

        // $button = Button::create([
        //     'href' => static::getAddOrdersToDeliveryIndexUrl(),
        //     'text' => 'warehouse::deliveries.associateDelivery',
        //     'icon' => 'plus'
        // ]);

        $button->setAjaxTableButton('order', [
            'openIframe' => true
        ]);

        $button->setPrimary();

        return $button;
    }

}