<?php

namespace App\Http\Livewire;

use App\Models\Agence;
use Livewire\Component;

class AgenceLivewire extends Component
{
	public $name;
	public $description = "HACKER INTERNATIONAL";
	public $identification;

	protected $rules = [
        'name' => 'required|min:3',
        
    ];
    public function render()
    {
    	$agences = Agence::paginate();
        return view('livewire.agence-livewire',['agences' => $agences]);
    }

    public function saveAgence(){
    	//$this->validate();
    	$data = [
    		"name" => $this->name,
    		"description" => $this->description
    	];

    	if($this->identification){

    	}else{
    		Agence::create($data);
    	}

    }
}
