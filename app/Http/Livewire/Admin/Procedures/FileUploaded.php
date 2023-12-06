<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use App\Models\Fileprocedure;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileUploaded extends Component
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

    public function changeState($formData): void
    {
        $file = Fileprocedure::where('id', '=', $formData['file_id'])->first();
        if($formData['state'] == NULL) {
            $this->notice('El archivo ya cuenta este estado', 'info');
        } else {
            if($file->state == $formData['state']){
                $this->notice('El archivo ya cuenta este estado', 'info');
            } else {
                Fileprocedure::where('id', '=', $formData['file_id'])->update(['state' => $formData['state']]);
                $this->notice('Se actualizo el estado correctamente', 'success');
            }
        }
    }

    public function render()
    {
        $this->files = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', 100]])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 101]])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 102]])->get();
        return view('livewire.admin.procedures.file-uploaded');
    }
}
