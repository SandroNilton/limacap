<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Procedure;
use App\Models\Area;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateForm extends Component
{
    public $areas;
    public $roles;

    public $user, $name, $email, $area, $password, $password_confirmation, $state;

    public $roles_val;

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'area' => 'required',
            'roles_val.*' => 'exists:roles,id',
        ];
    }

    public function mount(User $user): void
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->area = $user->area_id;
        $this->state = $user->state;

        $this->roles_val = $this->user->roles()->pluck('id')->toArray();

        $this->roles = Role::all();
        $this->areas = Area::where('state', '=', 'Activo')->get();
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();
        $this->user->update([
            'name' => Str::upper($this->name),
            'email' => $this->email,
            'area_id' => $this->area,
            'state' => $this->state
        ]);
        $this->user->roles()->sync($this->roles_val);
        return redirect()->route('admin.users.index')->notice('El usuario se actualizo correctamente', 'success');
    }

    public function destroy($user)
    {
        Procedures::where('admin_id', $user)->update(['admin_id' => NULL]);

        User::where('id', $user)->delete();
        $this->user->roles()->sync([]);

        return redirect()->route('admin.users.index')->notice('Se eliminó el usuario correctamente', 'alert');
    }

    public function render()
    {
        return view('livewire.admin.users.update-form');
    }
}
