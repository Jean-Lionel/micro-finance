<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\kirimbaOperation as KOperation;

class KirimbaOperationHistory extends Component
{
	public $compte_name = "K-";


    public function render()
    {

    	$operations = KOperation::latest()->where('compte_name', 'like',$this->compte_name.'%' )->paginate();

        return view('livewire.kirimba-operation-history',[

        	'operations' => $operations


        ]);
    }
}
