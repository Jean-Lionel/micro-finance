<?php

namespace App\Http\Livewire;

use App\Models\ComptePrincipal;
use App\Models\ComptePrincipalOperation;
use App\Models\TenueCompte;
use Livewire\Component;

class GeneralChart extends Component
{

	 public $currentMontant = 0.0;
	 public $retrait = 0.0;
	 public $versement = 0.0;
	 public $decouvert = 0.0;
	 public $placement = 0.0;
	 public $tenue_compte = 0.0;
	 public $depense = 0.0;


	public function render()
	{
		if(ComptePrincipal::all()->count() > 0){

			$this->currentMontant = ComptePrincipal::latest()->first()->montant;
			$this->retrait = ComptePrincipalOperation::all()->sum('retrait');
			$this->versement = ComptePrincipalOperation::all()->sum('versement');
			$this->placement = ComptePrincipalOperation::all()->sum('placement');
			$this->decouvert = ComptePrincipalOperation::all()->sum('decouvert');
			$this->tenue_compte = TenueCompte::all()->sum('montant');
			$this->depense = ComptePrincipalOperation::all()->sum('depense');
		}

	
			

		// dump($this->versement);

		return view('livewire.general-chart');
	}
}
