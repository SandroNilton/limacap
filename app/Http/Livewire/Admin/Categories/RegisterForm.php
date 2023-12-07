<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name = '';
    public $description = '';
    public $state = 'Activo';

    protected $rules = [
        'name' => 'required|unique:categories',
    ];

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();
        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state
        ]);
        return redirect()->route('admin.categories.index')->notice('La categoría se creo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.categories.register-form');
    }
}
