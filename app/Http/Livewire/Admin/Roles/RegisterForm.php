<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Role;
use App\Models\Permission;
use Livewire\Component;

class RegisterForm extends Component
{

    public $name = '';
    public $permissions = [];
    public $permissions_val = [];

    protected $rules = [
        'name' => 'required|unique:roles',
    ];

    public function mount(): void
    {
      $this->permissions = Permission::all();
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
        ]);

        $role->permissions()->sync($this->permissions_val);

        return redirect()->route('admin.roles.index')->notice('El rol se creo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.roles.register-form');
    }
}
