<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\KirimbaMembre;
use Illuminate\Support\Facades\DB;
use App\Models\KirimbaComptePrincipal;
use App\Models\kirimbaOperation as KOperation;


class KirimbaRapportLivire extends Component
{


//id 	kirimba_compte_id 	compte_name 	type_operation 	montant

    public function render()
    {
    	$membreTotal = KirimbaMembre::all()->count();
    	$montantKirimba = KirimbaComptePrincipal::first()->montant;
    	// $versement = KOperation::all()->where('type_operation','=', 'VERSEMENT')
    	// 								->whereDate ('created_at', Carbon::now())->sum('montant');

       $versement = DB::table('kirimba_operations')
       			->where('type_operation','=', 'VERSEMENT')
                ->whereDate('created_at', Carbon::now())
                ->get()->sum('montant');

        $retrait = DB::table('kirimba_operations')
       			->where('type_operation','=', 'RETRAIT')
                ->whereDate('created_at', Carbon::now())
                ->get()->sum('montant');


        $user_operations = DB::select("SELECT user_id ,type_operation,SUM(montant) as sum_montant from  kirimba_operations GROUP BY user_id , type_operation");

        return view('livewire.kirimba-rapport-livire',[
        	'membreTotal' => $membreTotal ,
        	'montantKirimba' => $montantKirimba,
        	'versement' => $versement,
        	'retrait' => $retrait,
        	'user_operations' => $user_operations


        ]);
    }
}
