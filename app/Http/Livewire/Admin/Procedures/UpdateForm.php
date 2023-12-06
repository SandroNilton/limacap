<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Fileprocedure;
use App\Models\Proceduremessagefinish;
use App\Models\Procedurehistory;
use App\Models\Procedure;
use App\Mail\ChangeStateProcedureMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Livewire\Component;

class UpdateForm extends Component
{
    use WithFileUploads;

    public $procedure;
    public $files_out;
    public $files, $comment, $state;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function assignState(): void
    {
        $this->validate(['state' => 'required', 'comment' => 'required']);

        if($this->procedure->state != $this->state){
            $this->procedure->update(['state' => $this->state]);

            Proceduremessagefinish::create([
                'procedure_id' => $this->procedure->id,
                'description' => $this->comment,
            ]);

            Procedurehistory::create([
                'procedure_id' => $this->procedure->id,
                'area_id' => $this->procedure->area_id,
                'admin_id' => auth()->user()->id,
                'action' => "El usuario ". auth()->user()->name ." cambio el estado a ". $this->state.".",
                'state' => $this->state
            ]);

            $date = Carbon::now()->format('Y');

            if ($this->files != null) {
                foreach ($this->files as $file) {
                    $path = Storage::put('procedures/'.$date."/".$this->procedure->id."", $file);
                    Fileprocedure::create([
                        'procedure_id' => $this->procedure->id,
                        'requirement_id' => 0,
                        'name' => $file->GetClientOriginalName(),
                        'file' => (string)$path,
                        'state' => $this->state
                    ]);
                }
            }

            $data = ["idprocedure" => $this->procedure->id, "typeprocedure" => $this->procedure->typeprocedure->name, "state" => $this->state];

            Mail::to($this->procedure->user->email)->send(new ChangeStateProcedureMailable($data));

            $this->notice('Se cambio el estado correctamente', 'success');
        } else {
            $this->notice('El tramite ya se encuentra con el estado seleccionado actualmente', 'info');
        }
    }

    public function render()
    {
        $this->files_out = Fileprocedure::where([['procedure_id', '=', $this->procedure->id], ['state', '=', "Sin verificar"]])->orWhere([['procedure_id', '=', $this->procedure->id], ['state', '=', "Rechazado"]])->get();
        return view('livewire.admin.procedures.update-form');
    }
}