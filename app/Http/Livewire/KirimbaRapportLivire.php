<?php

namespace App\Http\Livewire;

use App\Models\KirimbaCompte;
use App\Models\KirimbaComptePrincipal;
use App\Models\KirimbaMembre;
use App\Models\kirimbaOperation as KOperation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class KirimbaRapportLivire extends Component
{


//id 	kirimba_compte_id 	compte_name 	type_operation 	montant

    public function render()
    {
    	$membreTotal = KirimbaMembre::all()->count();
    	$montantKirimba = KirimbaComptePrincipal::first()->montant ?? 0;
    	// $versement = KOperation::all()->where('type_operation','=', 'VERSEMENT')
    	// 								->whereDate ('created_at', Carbon::now())->sum('montant');

        $membre_avec_dette = KirimbaCompte::where('montant','<',0)->get();

       $versement = DB::table('kirimba_operations')
       			->where('type_operation','=', 'VERSEMENT')
                ->whereDate('created_at', Carbon::now())
                ->get()->sum('montant');

        $retrait = DB::table('kirimba_operations')
       			->where('type_operation','=', 'RETRAIT')
                ->whereDate('created_at', Carbon::now())
                ->get()->sum('montant');

        $today = date('Y-m-d');


        $user_operations = DB::select("SELECT user_id ,type_operation,SUM(montant) as sum_montant from  kirimba_operations WHERE date(created_at) like '$today%'  GROUP BY user_id , type_operation");




        return view('livewire.kirimba-rapport-livire',[
        	'membreTotal' => $membreTotal ,
        	'montantKirimba' => $montantKirimba,
        	'versement' => $versement,
        	'retrait' => $retrait,
        	'user_operations' => $user_operations,
            'membre_avec_dette' => $membre_avec_dette


        ]);
    }
}
