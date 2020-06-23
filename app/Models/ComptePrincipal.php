<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComptePrincipal extends Model
{

	protected $fillable = ['montant'];

     protected $attributes = [
        'montant' => 500000,
    ];
}
