<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Typeprocedure;
use App\Models\Category;
use Livewire\Component;

class UpdateForm extends Component
{
    public $category, $name, $description, $state;

    protected function rules()
    {
        return [
            'name' => 'required|unique:categories,name,'.$this->category->id,
        ];
    }

    public function mount(Category $category): void
    {
        $this->name = $category->name;
        $this->description = $category->description;
        $this->state = $category->state;
        $this->category = $category;
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state
        ]);

        return redirect()->route('admin.categories.index')->notice('La categoría se actualizo correctamente', 'success');
    }

    public function destroy($category)
    {
        $category_exist_type_procedure = Typeprocedure::where([['category_id', '=', $category]])->get();
        
        if($category_in_typeprocedure->count() > 0){
            $this->notice('La categoría se encuentra en uso actualmente', 'info');
        } else {
            Category::where('id', $category)->delete();
            return redirect()->route('admin.categories.index')->notice('Se eliminó la categoría correctamente', 'alert');
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.update-form');
    }
}
