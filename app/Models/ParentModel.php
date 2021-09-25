<?php

namespace App\Models;

use App\Models\Compte;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * La class Parent
 */
class ParentModel extends Model
{	
	use Sortable;
	use SoftDeletes;

	public function getClientNameAttribute(){
		$compte = Compte::where('name','=', $this->compte_name)->first();
		return $compte->client->fullName ?? "";
	}

	// public function getCreatedAtAttribute($date)
	// {
	// 	return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	// }

	// public function getUpdatedAtAttribute($date)
	// {
	// 	return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	// }

}