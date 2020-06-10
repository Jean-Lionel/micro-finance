<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReboursementDecouvert extends ParentModel
{
     protected $fillable = ['compte_name','montant_rembourse','date_remboursement','client_id'];
     protected $sortable = ['compte_name','montant_rembourse','date_remboursement','client_id','created_at'];
   
}
