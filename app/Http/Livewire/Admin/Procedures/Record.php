<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use App\Models\Procedurehistory;
use Livewire\Component;

class Record extends Component
{
    public $procedure;
    public $records;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function render()
    {
        $this->records = Procedurehistory::where([['procedure_id', '=',  $this->procedure->id]])->get();
        return view('livewire.admin.procedures.record');
    }
}
