<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Area;
use App\Models\User;
use App\Models\Procedure;
use App\Models\Procedurehistory;
use App\Mail\ChangeAssigneProcedureMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Assignment extends Component
{       
    public $areas, $users;
    public $procedure;

    public $area, $user;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
        $this->area = $procedure->area_id;
        $this->user = $procedure->admin_id;
    }

    public function assignArea():void
    {
        $this->validate(['area' => 'required']);

        if($this->procedure->area_id != $this->area){
            $area = Area::where('id', '=', $this->area)->first();
            $this->procedure->update(['area_id' => $this->area]);
            Procedurehistory::create([
                'procedure_id' => $this->procedure->id,
                'area_id' => $this->area,
                'admin_id' => auth()->user()->id,
                'action' => "El usuario ". auth()->user()->name." asigno al area ".$area->name.".",
                'state' => 1
            ]);
            $this->notice('Se asigno al area correctamente', 'success');
        } else {
            $this->notice('El tramite ya se encuenrta en el área seleccionada actualmente', 'info');
        }
    }

    public function assignUser()
    {
        $this->validate(['user' => 'required']);

        if($this->procedure->admin_id != $this->user){
            $user = User::where('id', '=', $this->user)->first();
            if ($user->area != null) {
                $this->procedure->update(['admin_id' => $this->user, 'area_id' => $user->area_id]);
                Procedurehistory::create([
                    'procedure_id' => $this->procedure->id,
                    'area_id' => $user->area_id,
                    'admin_id' => auth()->user()->id,
                    'action' => "El usuario ".auth()->user()->name." asigno al usuario ".$user->name.".",
                    'state' => 1
                ]);
                $data = ["idprocedure" => $this->procedure->id, "area" => $user->area->name, "user" =>  $user->name, "admin" => auth()->user()->name];
                Mail::to($user->email)->send(new ChangeAssigneProcedureMailable($data));
                $this->notice('Se asigno al usuario correctamente', 'success');
            } else {
                $this->notice('El usuario no tiene un área asignada', 'info');
            }
        } else {
            $this->notice('El tramite ya se encuentra asignado al usuario seleccionado', 'info');
        }
    }

    public function render()
    {
        $this->areas = Area::where('state', '=', 1)->get();
        $this->users = User::where('state', '=', 1)->where('type', '=', 3)->get();
        return view('livewire.admin.procedures.assignment');
    }
}
