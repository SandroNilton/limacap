<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use Livewire\Component;

class Data extends Component
{
    public $procedure;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function render()
    {
        return view('livewire.admin.procedures.data');
    }
}
