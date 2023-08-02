<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Role;
use App\Models\Permission;
use Livewire\Component;

class Create extends Component
{

  public $permissions = [];

  public $name;
  public $permissions_val = [];

  protected $rules = [
    'name' => 'required|unique:roles',
  ];

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'name.unique' => 'El nombre ya existe',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function createRole()
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
    $this->permissions = Permission::all();
    return view('livewire.admin.roles.create');
  }
}
