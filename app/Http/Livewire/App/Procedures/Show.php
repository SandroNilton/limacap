<?php

namespace App\Http\Livewire\App\Procedures;

use Livewire\Component;
use App\Models\Procedure;

class Show extends Component
{

    public $procedure;

    public function render()
    {
        return view('livewire.app.procedures.show');
    }
}
