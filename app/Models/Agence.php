<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agence extends Model
{
    //

    use SoftDeletes;

    protected $guarded = [];

    public function users(){
    	return $this->hasMany("App\Models\User",'agence_id','id');

    }
}
