<?php

namespace App\Models;

use App\Models\ParentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHistory extends ParentModel
{
    use HasFactory;
    protected $guarded = ['id'];
}
