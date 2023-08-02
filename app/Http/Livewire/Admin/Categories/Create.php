<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;

use Livewire\Component;

class Create extends Component
{
  public $name;
  public $description;
  public $state;

  protected $rules = [
    'name' => 'required|unique:categories',
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
    $category = Category::create([
      'name' => $this->name,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.categories.index')->notice('La categoría se creo correctamente', 'success');
  }

  public function render()
  {
      return view('livewire.admin.categories.create');
  }
}
