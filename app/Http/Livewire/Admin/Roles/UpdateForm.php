<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class UpdateForm extends Component
{
    public $permissions = [];

    public $role, $name, $permissions_val = [];

    public function mount(Role $role): void
    {
        $this->name = $role->name;
        $this->permissions_val = $role->permissions()->pluck('id')->toArray();
        $this->role = $role;
        $this->permissions = Permission::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:users,name,'.$this->role->id,
        ];
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();
        $this->role->update([
            'name' => $this->name,
        ]);
        $this->role->permissions()->sync($this->permissions_val);
        return redirect()->route('admin.roles.index')->notice('El rol se actualizo correctamente', 'success');
    }

    public function destroy($role)
    {
        $role_exist_user = DB::table('model_has_roles')->where('role_id', '=', $role)->get();
        if($role_exist_user->count() > 0){
            $this->notice('El rol se encuentra en uso actualmente', 'info');
        } else {
            Role::where('id', $role)->delete();
            $this->role->permissions()->sync([]);
            return redirect()->route('admin.roles.index')->notice('Se eliminó el rol correctamente', 'alert');
        }
    }

    public function render()
    {
        return view('livewire.admin.roles.update-form');
    }
}
