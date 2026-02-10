<?php

namespace IlBronza\Category\Providers\DatatablesFields\Categories;

use IlBronza\Datatables\DatatablesFields\DatatableFieldFunction;
use IlBronza\Datatables\DatatablesFields\Links\DatatableFieldLink;

class DatatableFieldAddTo extends DatatableFieldLink
{
	public $htmlClasses = ['addToCategory'];
	public $function = 'getAddToCategoryUrl';
	public ?string $translationPrefix = 'category::datatableFields';

	public $faIcon = 'truck';

}