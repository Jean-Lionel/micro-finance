<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    //

    protected $fillable = ['client_id','motant','name'];

     public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
