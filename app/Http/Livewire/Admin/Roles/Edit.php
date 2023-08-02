<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class Edit extends Component
{
  public $role;

  public $permissions = [];

  public $name;

  public array $permissions_val;

  public function mount()
  {
    $this->role = Route::current()->parameter('role');
    $this->name = $this->role->name;

    $this->permissions_val = $this->role->permissions()->pluck('id')->toArray();
  }

  protected function rules()
  {
    return [
      'name' => 'required|unique:users,name,'.$this->role->id,
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

  public function updateRole()
  {
    $this->validate();
    $this->role->update([
      'name' => $this->name,
    ]);
    $this->role->permissions()->sync($this->permissions_val);
    return redirect()->route('admin.roles.index')->notice('El rol se actualizo correctamente', 'success');
  }

  public function deleteRole($role)
  {
    $role_in_user = DB::table('model_has_roles')->where('role_id', '=', $role)->get();
    if($role_in_user->count() > 0){
      $this->notice('El rol se encuentra en uso actualmente', 'info');
    } else {
      Role::where('id', $role)->delete();
      return redirect()->route('admin.roles.index')->notice('Se eliminó el rol correctamente', 'alert');
    }
  }

  public function render()
  {
    $this->permissions = Permission::all();
    return view('livewire.admin.roles.edit');
  }
}
