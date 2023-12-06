<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use App\Models\Fileprocedure;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileFinish extends Component
{
    public $procedure;
    public $files;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function render()
    {
        $this->files = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', 4]])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 5]])->get();
        return view('livewire.admin.procedures.file-finish');
    }
}
