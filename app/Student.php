<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Student extends Model
{
    //

    use Sortable;

    protected $fillable = ['first_name','last_name','age','date_naissance'];

    public $sortable = ['id',
                        'first_name',
                        'last_name',
                        'age',
                        'created_at',
                        'updated_at'];
}
