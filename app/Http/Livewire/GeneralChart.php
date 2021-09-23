<?php

namespace App\Http\Livewire;

use App\Models\ComptePrincipal;
use App\Models\ComptePrincipalOperation;
use App\Models\TenueCompte;
use App\Models\Operation;
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
	 public $remboursement = 0.0;
	 public $annulation_versement = 0.0;
	 public $annulation_retrait = 0.0;


	public function render()
	{
		if(ComptePrincipal::all()->count() > 0){

			$this->currentMontant = ComptePrincipal::latest()->first()->montant; 
			$datas = ComptePrincipalOperation::all();

			$this->versement = $datas->sum('versement');
			$this->retrait = $datas->sum('retrait');
			$this->placement = $datas->sum('placement');
			$this->decouvert = $datas->sum('decouvert');
			$this->remboursement = $datas->sum('reboursement');
			$this->tenue_compte = $datas->sum('tenue_compte');
			$this->annulation_versement = $datas->sum('annulation_versement');
			$this->annulation_retrait = $datas->sum('annulation_retrait');
			$this->paiment_placement = $datas->sum('paiment_placement');

 


			// = Operation::where('type_operation','=','VERSEMENT')->sum('montant');
   //     		  = Operation::where('type_operation','=','RETRAIT')->sum('montant');
   //     		 // placement
			// $this->placement = ComptePrincipalOperation::all()->sum('placement');
			// $this->decouvert = ComptePrincipalOperation::all()->sum('decouvert');
			// $this->tenue_compte = TenueCompte::all()->sum('montant');
			// $this->depense = ComptePrincipalOperation::all()->sum('depense');
			// $this->remboursement = ComptePrincipalOperation::all()->sum('reboursement');
			// $this->annulation_versement = ComptePrincipalOperation::all()->sum('annulation_versement');
			// $this->annulation_retrait = ComptePrincipalOperation::all()->sum('annulation_retrait');

		}

	
			

		// dump($this->versement);

		return view('livewire.general-chart');
	}
}
