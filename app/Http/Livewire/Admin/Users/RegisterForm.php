<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Area;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterForm extends Component
{
    public $areas;
    public $roles;

    public $name = '';
    public $email = '';
    public $area;
    public $password = '';
    public $password_confirmation = '';
    public $state = 0;
    public $roles_val = [];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'area' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required|same:password',
    ];

    public function mount(): void
    {
        $this->areas = Area::where('state', '=', 1)->get();
        $this->roles = Role::all();
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'type' => 3,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => Carbon::now()->timestamp,
            'password' => Hash::make($this->password),
            'area_id' => $this->area,
            'is_admin' => true,
            'state' => $this->state
        ]);

        $user->roles()->sync($this->roles_val);

        return redirect()->route('admin.users.index')->notice('El usuario se creo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.users.register-form');
    }
}
