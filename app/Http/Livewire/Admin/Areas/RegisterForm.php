<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name = '';
    public $description = '';
    public $state = 0;

    protected $rules = [
        'name' => 'required|unique:areas',
    ];

    public function updated($fields): void
    {
       $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();
        
        Area::create([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state
        ]);

        return redirect()->route('admin.areas.index')->notice('El área se creo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.areas.register-form');
    }
}
