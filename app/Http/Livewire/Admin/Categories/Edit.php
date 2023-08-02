<?php

namespace App\Http\Livewire\Admin\Categories;

use Illuminate\Support\Facades\Route;

use App\Models\Category;
use App\Models\Typeprocedure;
use Livewire\Component;

class Edit extends Component
{
  public $category;

  public $name;
  public $description;
  public $state;

  public function mount()
  {
    $this->category = Route::current()->parameter('category');
    $this->name = $this->category->name;
    $this->description = $this->category->description;
    $this->state = $this->category->state;
  }

  protected function rules()
  {
    return [
      'name' => 'required|unique:categories,name,'.$this->category->id,
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

  public function updateCategory()
  {
    $this->validate();

    $this->category->update([
      'name' => $this->name,
      'description' => $this->description,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    return redirect()->route('admin.categories.index')->notice('La categoría se actualizo correctamente', 'success');
  }

  public function deleteCategory($category)
  {
    $category_in_typeprocedure = Typeprocedure::where([['category_id', '=', $category]])->get();
    if($category_in_typeprocedure->count() > 0){
      $this->notice('La categoría se encuentra en uso actualmente', 'info');
    } else {
      Category::where('id', $category)->delete();
      return redirect()->route('admin.categories.index')->notice('Se eliminó la categoría correctamente', 'alert');
    }
  }
  public function render()
  {
      return view('livewire.admin.categories.edit');
  }
}
