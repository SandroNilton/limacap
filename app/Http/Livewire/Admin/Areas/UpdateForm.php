<?php

namespace App\Http\Livewire\Admin\Areas;

use App\Models\Typeprocedure;
use App\Models\Procedure;
use App\Models\User;
use App\Models\Area;
use Livewire\Component;

class UpdateForm extends Component
{
    public $area, $name, $description, $state = 0;

    protected function rules()
    {
        return [
            'name' => 'required|unique:areas,name,'.$this->area->id,
        ];
    }

    public function mount(Area $area): void
    {
        $this->name = $area->name;
        $this->description = $area->description;
        $this->state = $area->state;
        $this->area = $area;
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();

        $this->area->update([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state
        ]);

        return redirect()->route('admin.areas.index')->notice('El área se creo correctamente', 'success');
    }

    public function destroy($area)
    {
        $area_exist_type_procedure = Typeprocedure::where([['area_id', '=', $area]])->get();
        $area_exist_procedure = Procedure::where([['area_id', '=', $area]])->get();
        $area_exist_user = User::where([['area_id', '=', $area]])->get();

        if($area_exist_type_procedure->count() > 0 || $area_exist_procedure->count() > 0 || $area_exist_user->count() > 0){
            $this->notice('El área se encuentra en uso actualmente', 'info');
        } else {
            Area::where('id', $area)->delete();
            return redirect()->route('admin.areas.index')->notice('Se eliminó el área correctamente', 'alert');
        }
    }

    public function render()
    {
        return view('livewire.admin.areas.update-form');
    }
}
