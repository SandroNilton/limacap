<?php

namespace App\Http\Livewire\Admin\Typeprocedures;

use Illuminate\Support\Facades\Route;

use App\Models\Procedure;
use App\Models\Category;
use App\Models\Area;
use App\Models\Typeprocedure;
use Livewire\Component;

class Edit extends Component
{
  public $areas;
  public $castegories;
  public $typeprocedure;

  public $name;
  public $area_id;
  public $category_id;
  public $requirements = [];
  public $price;
  public $description;
  public $state;

  public array $requirements_val;

  public function mount()
  {
    $this->typeprocedure = Route::current()->parameter('typeprocedure');
    $this->name = $this->typeprocedure->name;
    $this->area_id = $this->typeprocedure->area_id;
    $this->category_id = $this->typeprocedure->category_id;
    $this->price = $this->typeprocedure->price;
    $this->description = $this->typeprocedure->description;
    $this->state = $this->typeprocedure->state;

    $this->requirements_val = $this->typeprocedure->requirements->pluck('id')->toArray();

  }

  protected function rules()
  {
    return [
      'name' => 'required|unique:users,name,'.$this->typeprocedure->id,
      'area_id' => 'required',
      'category_id' => 'required',
      'requirements_val.*' => 'exists:requirements,id',
    ];
  }

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'name.unique' => 'El nombre ya existe',
    'area_id.required' => 'El area es obligatorio',
    'category_id.required' => 'La categoría es obligatorio',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function updateTypeprocedure()
  {
    $this->validate();
    $this->typeprocedure->update([
      'name' => $this->name,
      'area_id' => $this->area_id,
      'category_id' => $this->category_id,
      'price' => $this->price,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    $this->typeprocedure->requirements()->sync($this->requirements_val);
    return redirect()->route('admin.typeprocedures.index')->notice('El tipo de trámite se actualizo correctamente', 'success');
  }

  public function deleteTypeprocedure($typeprocedure)
  {
    $typeprocedure_in_procedure = Procedure::where([['typeprocedure_id', '=', $typeprocedure]])->get();
    if($typeprocedure_in_procedure->count() > 0){
      $this->notice('El tipo de trámite se encuentra en uso actualmente', 'info');
    } else {
      Typeprocedure::where('id', $typeprocedure)->delete();
      return redirect()->route('admin.typeprocedures.index')->notice('Se eliminó el tipo de trámite correctamente', 'alert');
    }
  }

  public function render()
  {
    $this->areas = Area::where('state', '=', 'activo')->get();
    $this->categories = Category::where('state', '=', 'activo')->get();
    return view('livewire.admin.typeprocedures.edit');
  }
}
