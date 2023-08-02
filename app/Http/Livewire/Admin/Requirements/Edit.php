<?php

namespace App\Http\Livewire\Admin\Requirements;

use Illuminate\Support\Facades\Route;

use App\Models\Requirement;
use Livewire\Component;

class Edit extends Component
{
  public $requirement;

  public $name;
  public $description;
  public $state;

  public function mount()
  {
    $this->requirement = Route::current()->parameter('requirement');
    $this->name = $this->requirement->name;
    $this->description = $this->requirement->description;
    $this->state = $this->requirement->state;
  }

  protected function rules()
  {
    return [
      'name' => 'required|unique:requirements,name,'.$this->requirement->id,
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

  public function updateRequirement()
  {
    $this->validate();

    $this->requirement->update([
      'name' => $this->name,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.requirements.index')->notice('El requisito se actualizo correctamente', 'success');
  }

  public function deleteRequirement($requirement)
  {
    $requirement_in_typeprocedure = DB::table('requirement_typeprocedure')->join('requirements', 'requirement_typeprocedure.requirement_id', '=', 'requirements.id')->join('typeprocedures', 'requirement_typeprocedure.typeprocedure_id', '=', 'typeprocedures.id')->where([['requirement_typeprocedure.requirement_id', '=', $requirement]])->select('requirements.*')->get();
    if($requirement_in_typeprocedure->count() > 0){
      $this->notice('El requisito se encuentra en uso actualmente', 'info');
    } else {
      Requirement::where('id', $requirement)->delete();
      return redirect()->route('admin.requirements.index')->notice('Se eliminó el requisito correctamente', 'alert');
    }
  }

  public function render()
  {
    return view('livewire.admin.requirements.edit');
  }
}
