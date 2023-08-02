<?php

namespace App\Http\Livewire\Admin\Areas;

use Illuminate\Support\Facades\Route;

use App\Models\Typeprocedure;
use App\Models\Procedure;
use App\Models\User;
use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
  public $area;

  public $name;
  public $description;
  public $state;

  public function mount()
  {
    $this->area = Route::current()->parameter('area');
    $this->name = $this->area->name;
    $this->description = $this->area->description;
    $this->state = $this->area->state;
  }

  protected function rules()
  {
    return [
      'name' => 'required|unique:areas,name,'.$this->area->id,
    ];
  }

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'name.unique' => 'El nombre ya existe',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function updateArea()
  {
    $this->validate();

    $this->area->update([
      'name' => $this->name,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.areas.index')->notice('El área se actualizo correctamente', 'success');
  }

  public function deleteArea($area)
  {
    $area_in_typeprocedure = Typeprocedure::where([['area_id', '=', $area]])->get();
    $area_in_procedure = Procedure::where([['area_id', '=', $area]])->get();
    $area_in_user = User::where([['area_id', '=', $area]])->get();
    if($area_in_typeprocedure->count() > 0 || $area_in_procedure->count() > 0 || $area_in_user->count() > 0){
      $this->notice('El área se encuentra en uso actualmente', 'info');
    } else {
      Area::where('id', $area)->delete();
      return redirect()->route('admin.areas.index')->notice('Se eliminó el área correctamente', 'alert');
    }
  }

  public function render()
  {
    return view('livewire.admin.areas.edit');
  }
}
