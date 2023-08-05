<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Area;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
  public $areas;
  public $roles = [];

  public $name;
  public $email;
  public $area_id;
  public $password;
  public $password_confirmation;
  public $state;
  public $roles_val = [];

  protected $rules = [
    'name' => 'required',
    'email' => 'required|email|unique:users',
    'area_id' => 'required',
    'password' => 'required',
    'password_confirmation' => 'required|same:password',
  ];

  protected $messages = [
    'name.required' => 'El nombre es obligatorio.',
    'email.required' => 'El correo electrónico es obligatorio.',
    'email.email' => 'El correo electrónico no es válido',
    'email.unique' => 'El correo electrónico ya existe',
    'area_id.required' => 'El area es obligatorio',
    'password.required' => 'La contraseña es obligatoria.',
    'password_confirmation.required' => 'La confirmación de contraseña es obligatoria.',
    'password_confirmation.same' => 'Ambas contraseñas deben ser iguales',
  ];

  public function updated($fields)
  {
    $this->validateOnly($fields);
  }

  public function createUser()
  {
    $this->validate();
    $user = User::create([
      'type' => 10,
      'name' => $this->name,
      'email' => $this->email,
      'email_verified_at' => Carbon::now()->timestamp,
      'password' => Hash::make($this->password),
      'area_id' => $this->area_id,
      'is_admin' => true,
      'state' => ($this->state == NULL) ? 'activo' : $this->state
    ]);
    $user->roles()->sync($this->roles_val);
    return redirect()->route('admin.users.index')->notice('El usuario se creo correctamente', 'success');
  }

  public function render()
  {
    $this->roles = Role::all();
    $this->areas = Area::where('state', '=', 'activo')->get();
    return view('livewire.admin.users.create');
  }
}
