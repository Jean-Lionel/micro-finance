<?php

namespace App\Http\Livewire;

use App\Models\Agence;
use App\Models\AgenceOperation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GestionAgenceLivewire extends Component
{
	public $montant;
	public $agence_id;
	protected $rules = [
		"montant" => "required|numeric|min:10000",
		"agence_id" => "required|numeric|between:1,2",
	];
    public function render()
    {
    	//JE LIMITE LES AGANCES A 2 DONC KINAMA ET 

        // SELECT agence_id, SUM(`montant`) FROM `caisse_caissiers` GROUP BY agence_id
    	$agences = DB::select("SELECT agence_id, SUM(`montant`) as montant FROM `caisse_caissiers` GROUP BY agence_id");

        //dd($agences[0]->agence_id);
        return view('livewire.gestion-agence-livewire',[
        	'agences' => $agences 
        ]);
    }
    public function saveMontantAgence(){
    	 $a = $this->validate($this->rules);
    	 $data = [
    	 	"montant" => $this->montant,
			"agence_id" => $this->agence_id,
			"type_operation" => "VERSEMENT",
    	 ];
    	 try {
    	 	DB::beginTransaction();
    	 		$agence = Agence::find($this->agence_id);
    	 		$agence->montant += $this->montant;
    	 		$agence->save();
    	 		AgenceOperation::create($data);
                $this->reset();
    	 	DB::commit();
    	 	
    	 } catch (\Exception $e) {
    	 	dump($e);
    	 	DB::rollback();
    	 }
    }
}
