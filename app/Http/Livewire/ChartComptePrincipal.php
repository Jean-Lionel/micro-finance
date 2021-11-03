<?php

namespace App\Http\Livewire;
use App\Models\ComptePrincipal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartComptePrincipal extends Component
{

	public $name = "JEAN";
    
    public function render()
    {
        $currentMontant = 0.0;

        $agences = DB::select("SELECT agence_id, SUM(`montant`) as montant FROM `caisse_caissiers` GROUP BY agence_id");

        if(ComptePrincipal::all()->count() > 0)
        	$currentMontant = ComptePrincipal::latest()->first()->montant;
        
        return view('livewire.chart-compte-principal',[
        	'value' => $currentMontant,
        	'agences' => $agences
        ]);
    }
}
