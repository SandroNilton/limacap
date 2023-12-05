<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Area;
use App\Models\User;
use App\Models\Procedure;
use App\Models\Procedurehistory;
use Livewire\Component;

class Assignment extends Component
{       
    public $areas, $users;
    public $procedure;

    public $area, $user;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
        $this->areas = Area::where('state', '=', 1)->get();
        $this->users = User::where('state', '=', 1)->where('type', '=', 3)->get();

        $this->area = $procedure->area_id;
        $this->user = $procedure->admin_id;
    }

    public function assignArea():void
    {
        $this->validate(['area' => 'required']);

        if($this->procedure->area_id != $this->area){
          Procedure::where('id', '=', $this->procedure->id)->update(['area_id' => $this->area]);


          $area_data = Area::where('id', '=', $this->area)->get();
          Procedurehistory::create([
            'procedure_id' => $this->procedure->id,
            'area_id' => $this->area,
            'admin_id' => auth()->user()->id,
            'action' => "El usuario ". auth()->user()->name ." asigno al area ". $area_data[0]->name.".",
            'state' => 'asignado'
          ]);
          $this->reset('area');
          $this->notice('Se asigno al area correctamente', 'success');
        } else {
          $this->notice('El tramite ya se encuenrta en el área seleccionada actualmente', 'info');
        }
    }

    public function assignUser()
    {
        $this->validate(['user' => 'required']);

      if($this->procedure->admin_id != $this->user){
        $user_get_area = User::where('id', '=', $this->user)->get();
        Procedure::where('id', '=', $this->procedure->id)->update(array('admin_id' => $this->user, 'area_id' => $user_get_area[0]->area_id));
        Procedurehistory::create([
          'procedure_id' => $this->procedure->id,
          'area_id' => $user_get_area[0]->area_id,
          'admin_id' => auth()->user()->id,
          'action' => "El usuario ". auth()->user()->name ." asigno al usuario ". $user_get_area[0]->name.".",
          'state' => 'asignado'
        ]);

        $area = Area::where([['id', '=', $user_get_area[0]->area_id]])->get();
        $user = User::where([['id', '=', $this->user]])->get();

        $data = ["idprocedure" => $this->procedure->id, "area" => $area[0]->name, "user" =>  $user[0]->name, "admin" => auth()->user()->name];

        Mail::to($user[0]->email)->send(new ChangeAssigneProcedureMailable($data));

        $this->reset('user_id');
        $this->notice('Se asigno al usuario correctamente', 'success');
      } else {
        $this->notice('El tramite ya se encuentra asignado al usuario seleccionado', 'info');
      }
    }

    public function render()
    {
        return view('livewire.admin.procedures.assignment');
    }
}
