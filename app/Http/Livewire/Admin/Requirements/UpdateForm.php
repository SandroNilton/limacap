<?php

namespace App\Http\Livewire\Admin\Requirements;

use Illuminate\Support\Facades\DB;
use App\Models\Requirement;
use Livewire\Component;

class UpdateForm extends Component
{
    public $requirement, $name, $description, $state = 0;

    protected function rules()
    {
        return [
            'name' => 'required|unique:requirements,name,'.$this->requirement->id,
        ];
    }

    public function mount(Requirement $requirement): void
    {
        $this->name = $requirement->name;
        $this->description = $requirement->description;
        $this->state = $requirement->state;
        $this->requirement = $requirement;
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();

        $this->requirement->update([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state
        ]);

        return redirect()->route('admin.requirements.index')->notice('El requisito se actualizo correctamente', 'success');
    }

    public function destroy($requirement)
    {
        $requirement_exist_type_procedure = DB::table('requirement_typeprocedure')->join('requirements', 'requirement_typeprocedure.requirement_id', '=', 'requirements.id')->join('typeprocedures', 'requirement_typeprocedure.typeprocedure_id', '=', 'typeprocedures.id')->where([['requirement_typeprocedure.requirement_id', '=', $requirement]])->select('requirements.*')->get();
        if($requirement_exist_type_procedure->count() > 0){
            $this->notice('El requisito se encuentra en uso actualmente', 'info');
        } else {
            Requirement::where('id', $requirement)->delete();
            return redirect()->route('admin.requirements.index')->notice('Se eliminó el requisito correctamente', 'alert');
        }
    }

    public function render()
    {
        return view('livewire.admin.requirements.update-form');
    }
}
