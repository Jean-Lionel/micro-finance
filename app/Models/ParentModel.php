<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

/**
 * La class Parent
 */
class ParentModel extends Model
{

	
	 use Sortable;
	 use SoftDeletes;
}