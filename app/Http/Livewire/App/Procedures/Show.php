<?php

namespace App\Http\Livewire\App\Procedures;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Fileprocedure;
use App\Models\Procedure;
use App\Models\Proceduremessagefinish;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{

    use WithFileUploads;

    public $procedure;
    public $procedure_data;
    public $file_replace = [];

    public function mount()
    {
      $this->procedure = Route::current()->parameter('procedure');
    }

    public function downloadFile($id, $name, $file)
    {
      $headers = ['Content-Description' => 'File Transfer', 'Content-Type' => Storage::mimeType($name),];
      return Storage::download($file, $name, $headers);
    }

    public function changeFile($id, $requirement_id, $name, $file)
    {
        $this->validate(
            [
              'file_replace' => 'required'
            ],
            [
              'file_replace.required' => 'seleccione archivo de reemplazo',
            ]
          );
          $date = Carbon::now()->format('Y');

          foreach ($this->file_replace as $file) {
            $file_url = Storage::put('procedures/'.$date."/".$this->procedure->id."",  $file);
            Fileprocedure::create([
                'procedure_id' => $this->procedure->id,
                'requirement_id' => $requirement_id,
                'name' =>  $file->GetClientOriginalName(),
                'file' => (string)$file_url,
                'state' => 'Sin verificar'
            ]);
        }

        Fileprocedure::where('id', $id)->delete();
        Storage::delete($file);


        $this->notice('Se reemplazo correctamente', 'success');
    }

    public function render()
    {
        $this->procedure_data = Procedure::where('id', '=', $this->procedure)->get();
        $this->procedure_files = Fileprocedure::where([['procedure_id', '=', $this->procedure], ['state', '=', 'Sin verificar']])->orWhere([['procedure_id', '=', $this->procedure], ['state', '=', 'Aceptado']])->orWhere([['procedure_id', '=', $this->procedure], ['state', '=', 'Rechazado']])->get();
        $this->procedure_files_finish = Fileprocedure::where([['procedure_id', '=', $this->procedure], ['state', '=', 'Aprobado']])->orWhere([['procedure_id', '=', $this->procedure], ['state', '=', 'Cancelado']])->get();

        $this->procedure_files_responses = Fileprocedure::where([['procedure_id', '=', $this->procedure], ['state', '!=', 'Sin verificar'], ['state', '!=', 'Aceptado'], ['state', '!=', 'Rechazado'], ['state', '!=', 'Aprobado'], ['state', '!=', 'Cancelado']])->get();
        $this->procedure_message_finish = Proceduremessagefinish::where([['procedure_id', '=', $this->procedure]])->get();

        return view('livewire.app.procedures.show');
    }
}
