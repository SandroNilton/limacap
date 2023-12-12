<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Area;
use Livewire\Component;
use Illuminate\Support\Str;

class RegisterForm extends Component
{
    public $name = '';
    public $description = '';
    public $state = "Activo";

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
            'name' => Str::upper($this->name),
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
