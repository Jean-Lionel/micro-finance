<?php

namespace App\Http\Livewire;
use App\Models\ComptePrincipal;
use Livewire\Component;

class ChartComptePrincipal extends Component
{

	public $name = "JEAN";

    public function render()
    {
        $currentMontant = ComptePrincipal::latest()->first()->montant;
        
        return view('livewire.chart-compte-principal',['value' => $currentMontant]);
    }
}
