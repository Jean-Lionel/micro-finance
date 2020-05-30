<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    //

    protected $fillable = ['client_id','motant'];

     public function clients()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
