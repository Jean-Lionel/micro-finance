<?php

namespace App\Http\Livewire;

use App\Models\CaisseCaissier;
use App\Models\OperationCaisse;
use Livewire\Component;

class HistoriqueCaissier extends Component
{
    public $caise_id;

    public function mount($post){
        $this->caise_id = $post;

    }
    public function render()
    {
        $caisse = CaisseCaissier::find($this->caise_id);

        $operations = OperationCaisse::where('user_id', $caisse->id)->latest()->paginate(20);

        return view('livewire.historique-caissier',[
            'operations' => $operations,
            'caisse' => $caisse,
        ]);
    }
}
