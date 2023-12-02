<?php

namespace App\Http\Livewire\Admin\Requirements;

use App\Models\Requirement;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name = '';
    public $description = '';
    public $state = 0;

    protected $rules = [
        'name' => 'required|unique:requirements',
    ];

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        $requirement = Requirement::create([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state
        ]);

        return redirect()->route('admin.requirements.index')->notice('El requisito se creo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.requirements.register-form');
    }
}
