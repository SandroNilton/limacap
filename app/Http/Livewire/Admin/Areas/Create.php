<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use Carbon\Carbon;

use Livewire\Component;

class Create extends Component
{
  public $name;
  public $description;
  public $state;

  protected $rules = [
    'name' => 'required|unique:areas',
  ];

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'name.unique' => 'El nombre ya existe',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function createArea()
  {
    $this->validate();
    $area = Area::create([
      'name' => $this->name,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.areas.index')->notice('El área se creo correctamente', 'success');
  }

  public function render()
  {
    return view('livewire.admin.areas.create');
  }
}
