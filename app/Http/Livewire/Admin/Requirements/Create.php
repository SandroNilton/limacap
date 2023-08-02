<?php

namespace App\Http\Livewire\Admin\Requirements;

use App\Models\Requirement;
use Carbon\Carbon;

use Livewire\Component;

class Create extends Component
{
  public $name;
  public $description;
  public $state;

  protected $rules = [
    'name' => 'required|unique:requirements',
  ];

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'name.unique' => 'El nombre ya existe',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function createRequirement()
  {
    $this->validate();
    $requirement = Requirement::create([
      'name' => $this->name,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.requirements.index')->notice('El requisito se creo correctamente', 'success');
  }

  public function render()
  {
    return view('livewire.admin.requirements.create');
  }
}
