<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KirimbaCompte extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];
}
