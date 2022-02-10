<?php

namespace App\Http\Livewire;

use App\Models\Decouvert;
use Livewire\Component;

class UpdateDecourt extends Component
{
    public $decouvert_id;
    public $show_input;
    public $periode;

    public function mount($decouvert){
        $this->decouvert_id = $decouvert;

    }
    public function render()
    {
        return view('livewire.update-decourt');
    }

    public function augmenterPeriode()
    {
        // code...
        $decouvert = Decouvert::findOrFail($this->decouvert_id);

        dd($decouvert);
    }
}
