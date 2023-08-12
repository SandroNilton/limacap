<?php

namespace App\Http\Livewire\Admin\Procedures;

use Illuminate\Support\Facades\Route;

use App\Models\Procedure;
use App\Models\Proceduremessage;
use App\Models\Proceduremessagefinish;
use App\Models\Procedurehistory;
use App\Models\Fileprocedure;

use App\Models\Area;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;

use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $procedure;

    public $procedure_data;
    public $procedure_messages;
    public $procedure_files;
    public $procedure_histories;

    public $procedure_accepted;

    public $message;

    public $areas;
    public $users;

    public $area_id;
    public $user_id;
    public $stateproc_id;

    public $message_finish;
    public $file_finish;

    public $procedure_message_finish;
    public $procedure_files_finish;

    public function mount()
    {
      $this->procedure = Route::current()->parameter('procedure');
    }

    public function addMessage()
    {
      $this->validate(['message' => 'required'], ['message.required' => 'Rellena este campo obligatorio',]);
      $messages = ['procedure_id' => $this->procedure->id, 'description' => $this->message];
      Proceduremessage::create($messages);
      $this->reset('message');
    }

    public function downloadFile($id, $name, $file)
    {
      $headers = ['Content-Description' => 'File Transfer', 'Content-Type' => Storage::mimeType($name),];
      return Storage::download($file, $name, $headers);
    }

    public function changeArea()
    {
      $this->validate(['area_id' => 'required'], ['area_id.required' => 'Seleccione este campo obligatorio',]);
      if($this->procedure->area_id != $this->area_id){
        Procedure::where('id', '=', $this->procedure->id)->update(['area_id' => $this->area_id]);
        $area_data = Area::where('id', '=', $this->area_id)->get();
        Procedurehistory::create([
          'procedure_id' => $this->procedure->id,
          'area_id' => $this->area_id,
          'admin_id' => auth()->user()->id,
          'action' => "El usuario ". auth()->user()->name ." asigno al area ". $area_data[0]->name.".",
          'state' => 'asignado'
        ]);
        $this->reset('area_id');
        $this->notice('Se asigno al area correctamente', 'success');
      } else {
        $this->notice('El tramite ya se encuenrta en el área seleccionada actualmente', 'info');
      }
    }

    public function assignUser()
    {
      $this->validate(['user_id' => 'required'], ['user_id.required' => 'Seleccione este campo obligatorio',]);
      if($this->procedure->administrator_id != $this->user_id){
        $user_get_area = User::where('id', '=', $this->user_id)->get();
        Procedure::where('id', '=', $this->procedure->id)->update(array('admin_id' => $this->user_id, 'area_id' => $user_get_area[0]->area_id));
        Procedurehistory::create([
          'procedure_id' => $this->procedure->id,
          'area_id' => $user_get_area[0]->area_id,
          'admin_id' => auth()->user()->id,
          'action' => "El usuario ". auth()->user()->name ." asigno al usuario ". $user_get_area[0]->name.".",
          'state' => 'asignado'
        ]);
        $this->reset('user_id');
        $this->notice('Se asigno al usuario correctamente', 'success');
      } else {
        $this->notice('El tramite ya se encuentra asignado al usuario seleccionado', 'info');
      }
    }

    public function assignStateProcedure()
    {
        $this->validate(['stateproc_id' => 'required'], ['stateproc_id.required' => 'Seleccione este campo obligatorio',]);
        if($this->procedure->state != $this->stateproc_id){
          Procedure::where('id', '=', $this->procedure->id)->update(['state' => $this->stateproc_id]);
          Procedurehistory::create([
            'procedure_id' => $this->procedure->id,
            'area_id' => $this->procedure->area_id,
            'admin_id' => auth()->user()->id,
            'action' => "El usuario ". auth()->user()->name ." cambio el estado a ". $this->stateproc_id.".",
            'state' => $this->stateproc_id
          ]);
          $this->notice('Se cambio el estado correctamente', 'success');
        } else {
          $this->notice('El tramite ya se encuentra con el estado seleccionado actualmente', 'info');
        }
    }

    public function changeStateFile($formData)
    {
      $file_get_state = Fileprocedure::where('id', '=', $formData['procedurefile_id'])->get();
      if($formData['state_id'] == NULL) {
        $this->notice('El archivo ya cuenta este estado', 'info');
      } else {
        if($file_get_state[0]->state == $formData['state_id']){
          $this->notice('El archivo ya cuenta este estado', 'info');
        } else {
          Fileprocedure::where('id', '=', $formData['procedurefile_id'])->update(['state' => $formData['state_id']]);
          $this->notice('Se actualizo el estado correctamente', 'success');
        }
      }
    }

    public function finish_procedure()
    {
      $this->validate(
        [
          'message_finish' => 'required',
          'file_finish' => 'required'
        ],
        [
          'file_finish.required' => 'Seleccione archivos de respuesta',
          'message_finish.required' => 'Rellena este campo obligatorio',
        ]
      );
      Procedure::where('id', '=', $this->procedure->id)->update(['state' => 'aprobado']);
      Proceduremessagefinish::create([
        'procedure_id' => $this->procedure->id,
        'description' => $this->message_finish,
      ]);
      Procedurehistory::create([
        'procedure_id' => $this->procedure->id,
        'area_id' => $this->procedure->area_id,
        'admin_id' => auth()->user()->id,
        'action' => "El usuario ". auth()->user()->name ." finalizo el tramite aprobado",
        'state' => 'aprobado'
      ]);
      $date = Carbon::now()->format('Y');
      foreach ($this->file_finish as $file) {
        $file_url = Storage::put('procedures/'.$date."/".$this->procedure->id."", $file);
        Fileprocedure::create([
          'procedure_id' => $this->procedure->id,
          'requirement_id' => 0,
          'name' => $file->GetClientOriginalName(),
          'file' => (string)$file_url,
          'state' => 'aprobado'
        ]);
      }
      $this->notice('Trámite finalizado aprobado correctamente', 'success');
    }

    public function finish_procedure_decline(){
      Procedure::where('id', '=', $this->procedure->id)->update(['state' => 'rechazado']);
      Procedurehistory::create([
        'procedure_id' => $this->procedure->id,
        'area_id' => $this->procedure->area_id,
        'admin_id' => auth()->user()->id,
        'action' => "El usuario ". auth()->user()->name ." finalizo el tramite rechazado",
        'state' => 'rechazado'
      ]);
      $this->notice('Trámite finalizado rechazado correctamente', 'alert');
    }

    public function render()
    {
      $this->procedure_data = Procedure::where('id', '=', $this->procedure->id)->get();
      $this->procedure_messages = Proceduremessage::where('procedure_id', '=', $this->procedure->id)->orderBy('created_at', 'desc')->get();
      $this->procedure_files = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '!=', 'aprobado'], ['state', '!=', 'rechazado']])->get();
      $this->procedure_histories = Procedurehistory::where([['procedure_id', '=',  $this->procedure->id]])->get();

      $this->areas = Area::where('state', '=', 'activo')->get();
      $this->users = User::where([['state', '=', 'activo'], ['type', '=', 10], ['name', '!=' ,'admin']])->get();

      $this->procedure_files_finish = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', 'aprobado']])->get();
      $this->procedure_message_finish = Proceduremessagefinish::where([['procedure_id', '=', $this->procedure->id]])->get();

      $this->procedure_accepted = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', 'sin verificar']])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', 'rechazado']])->get();

      return view('livewire.admin.procedures.edit');
    }
}
