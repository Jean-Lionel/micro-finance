<?php

namespace App\Http\Livewire;
use App\Models\ComptePrincipal;
use Livewire\Component;

class ChartComptePrincipal extends Component
{

	public $name = "JEAN";

    public function render()
    {
        $currentMontant = 0.0;

        if(ComptePrincipal::all()->count() > 0)
        	$currentMontant = ComptePrincipal::latest()->first()->montant;
        
        
        return view('livewire.chart-compte-principal',['value' => $currentMontant]);
    }
}
