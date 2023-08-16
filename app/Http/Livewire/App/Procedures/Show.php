<?php

namespace App\Http\Livewire\App\Procedures;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Fileprocedure;
use App\Models\Procedure;
use App\Models\Proceduremessagefinish;
use Livewire\Component;

class Show extends Component
{

    public $procedure;
    public $procedure_data;

    public function mount()
    {
      $this->procedure = Route::current()->parameter('procedure');
    }

    public function downloadFile($id, $name, $file)
    {
      $headers = ['Content-Description' => 'File Transfer', 'Content-Type' => Storage::mimeType($name),];
      return Storage::download($file, $name, $headers);
    }

    public function render()
    {
        $this->procedure_data = Procedure::where('id', '=', $this->procedure->id)->get();
        $this->procedure_files = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', 'sinverificar']])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 'aceptado']])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 'rechazado']])->get();
        $this->procedure_files_finish = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', 'aprobado']])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 'cancelado']])->get();

        $this->procedure_files_responses = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '!=', 'sinverificar'], ['state', '!=', 'aceptado'], ['state', '!=', 'rechazado'], ['state', '!=', 'aprobado'], ['state', '!=', 'cancelado']])->get();
        $this->procedure_message_finish = Proceduremessagefinish::where([['procedure_id', '=', $this->procedure->id]])->get();

        return view('livewire.app.procedures.show');
    }
}
