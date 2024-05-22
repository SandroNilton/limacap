<?php

namespace App\Http\Livewire\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Fileprocedure;
use App\Models\Proceduremessagefinish;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use App\Models\Procedure;
use Livewire\Component;

class Consult extends Component
{
    public $code;
    public $procedure_data;
    use WithFileUploads;

    protected $rules = [
        'code' => 'required',
    ];

    public function downloadFile($id, $name, $file)
    {
      $headers = ['Content-Description' => 'File Transfer', 'Content-Type' => Storage::mimeType($name),];
      return Storage::download($file, $name, $headers);
    }

    public function consult()
    {
        $this->validate();
        $this->procedure_data = Procedure::where([['id', '=', $this->code]])->first();
        $this->procedure_files = Fileprocedure::where([['procedure_id', '=', $this->code], ['state', '=', 'Sin verificar']])->orWhere([['procedure_id', '=', $this->code], ['state', '=', 'Aceptado']])->orWhere([['procedure_id', '=', $this->code], ['state', '=', 'Rechazado']])->get();
        $this->procedure_files_finish = Fileprocedure::where([['procedure_id', '=', $this->code], ['state', '=', 'Aprobado']])->orWhere([['procedure_id', '=', $this->code], ['state', '=', 'Cancelado']])->get();
        $this->procedure_files_responses = Fileprocedure::where([['procedure_id', '=', $this->code], ['state', '!=', 'Sin verificar'], ['state', '!=', 'Aceptado'], ['state', '!=', 'Rechazado'], ['state', '!=', 'Aprobado'], ['state', '!=', 'Cancelado']])->get();
        $this->procedure_message_finish = Proceduremessagefinish::where([['procedure_id', '=', $this->code]])->get();
    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.auth.consult');
    }
}
