<?php

namespace App\Http\Livewire;

use App\Models\KirimbaCompte;
use Livewire\Component;
use Livewire\WithPagination;

class KirimbaRapportDette extends Component
{
	use WithPagination; 


    public function render()
    {
    	$comptes = KirimbaCompte::where('montant', '<', 0)->get();
        return view('livewire.kirimba-rapport-dette', [
        	'comptes' => $comptes
     
        ]);
    }
}
