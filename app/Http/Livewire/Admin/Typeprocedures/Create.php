<?php

namespace App\Http\Livewire\Admin\Typeprocedures;

use App\Models\Area;
use App\Models\Category;
use App\Models\Typeprocedure;
use Livewire\Component;

class Create extends Component
{
  public $areas;
  public $categories;

  public $name;
  public $area_id;
  public $category_id;
  public $requirements = [];
  public $price;
  public $description;
  public $state;

  protected $rules = [
    'name' => 'required|unique:requirements',
    'area_id' => 'required',
    'category_id' => 'required',
    'requirements' => 'required',
  ];

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

  public function createTypeprocedure()
  {
    $this->validate();
    $typeprocedure = Typeprocedure::create([
      'name' => $this->name,
      'area_id' => $this->area_id,
      'category_id' => $this->category_id,
      'description' => $this->description,
      'price' => $this->price,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    $typeprocedure->requirements()->sync($this->requirements);
    return redirect()->route('admin.typeprocedures.index')->notice('El tipo de trámite se creo correctamente', 'success');
  }

  public function render()
  {
    $this->areas = Area::where('state', '=', 'activo')->get();
    $this->categories = Category::where('state', '=', 'activo')->get();
    return view('livewire.admin.typeprocedures.create');
  }
}
