<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use App\Models\Fileprocedure;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileAnswers extends Component
{
    public $procedure;
    public $files;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function downloadFile($id, $name, $file)
    {
        $headers = ['Content-Description' => 'File Transfer', 'Content-Type' => Storage::mimeType($name),];
        return Storage::download($file, $name, $headers);
    }

    public function render()
    {
        $this->files = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '!=', 100], ['state', '!=', 101], ['state', '!=', 102], ['state', '!=', 4], ['state', '!=', 5]])->get();
        return view('livewire.admin.procedures.file-answers');
    }
}
