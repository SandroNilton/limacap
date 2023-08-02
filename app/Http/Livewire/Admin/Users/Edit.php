<?php

namespace App\Http\Livewire\Admin\Users;

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Area;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
  public $areas;
  public $roles = [];
  public $user;

  public $name;
  public $email;
  public $area_id;
  public $password;
  public $password_confirmation;
  public $state;

  public array $roles_val;

  public function mount()
  {
    $this->user = Route::current()->parameter('user');
    $this->name = $this->user->name;
    $this->email = $this->user->email;
    $this->area_id = $this->user->area_id;
    $this->state = $this->user->state;

    $this->roles_val = $this->user->roles()->pluck('id')->toArray();
  }

  protected function rules()
  {
    return [
      'name' => 'required|unique:users,name,'.$this->user->id,
      'email' => 'required|email|unique:users,email,'.$this->user->id,
      'area_id' => 'required',
      'roles_val.*' => 'exists:roles,id',
    ];
  }

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'name.unique' => 'El nombre ya existe',
    'email.required' => 'El correo electrónico es obligatorio.',
    'email.email' => 'El correo electrónico no es válido',
    'email.unique' => 'El correo electrónico ya existe',
    'area_id.required' => 'El area es obligatorio',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function updateUser()
  {
    $this->validate();
    $this->user->update([
      'name' => $this->name,
      'email' => $this->email,
      'area_id' => $this->area_id,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    $this->user->roles()->sync($this->roles_val);
    return redirect()->route('admin.users.index')->notice('El usuario se actualizo correctamente', 'success');
  }

  public function deleteUser($user)
  {
    User::where('id', $user)->delete();
    return redirect()->route('admin.users.index')->notice('Se eliminó el usuario correctamente', 'alert');
  }

  public function render()
  {
    $this->roles = Role::all();
    $this->areas = Area::where('state', '=', 'activo')->get();
    return view('livewire.admin.users.edit');
  }
}
