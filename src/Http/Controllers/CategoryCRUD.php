<?php

namespace IlBronza\Category\Http\Controllers;

use IlBronza\CRUD\CRUD;
use IlBronza\CRUD\Http\Controllers\BasePackageTrait;

class CategoryCRUD extends CRUD
{
	use BasePackageTrait;

	static $packageConfigPrefix = 'category';
	public $configModelClassName = 'category';
}
