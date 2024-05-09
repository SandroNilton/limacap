<?php

namespace App\Http\Livewire\Admin\Typeprocedures;

use App\Models\Procedure;
use App\Models\Category;
use App\Models\Area;
use App\Models\Typeprocedure;
use Illuminate\Support\Str;
use Livewire\Component;

class UpdateForm extends Component
{
    public $areas;
    public $categories;

    public $typeprocedure, $name, $area, $category, $requirements = [], $price, $description, $state;

    public array $requirements_val;

    protected function rules()
    {
        return [
            'name' => 'required|unique:users,name,'.$this->typeprocedure->id,
            'area' => 'required',
            'category' => 'required',
            'requirements_val.*' => 'exists:requirements,id',
        ];
    }

    public function mount(Typeprocedure $typeprocedure): void
    {
        $this->name = $typeprocedure->name;
        $this->area = $typeprocedure->area_id;
        $this->category = $typeprocedure->category_id;
        $this->price = $typeprocedure->price;
        $this->description = $typeprocedure->description;
        $this->state = $typeprocedure->state;
        $this->typeprocedure = $typeprocedure;
        $this->requirements_val = $this->typeprocedure->requirements->pluck('id')->toArray();
        $this->areas = Area::where('state', '=', 'Activo')->get();
        $this->categories = Category::where('state', '=', 'Activo')->get();
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();

        $this->typeprocedure->update([
          'name' => Str::upper($this->name),
          'area_id' => $this->area,
          'category_id' => $this->category,
          'price' => $this->price,
          'description' => $this->description,
          'state' => $this->state
        ]);

        $this->typeprocedure->requirements()->sync($this->requirements_val);

        return redirect()->route('admin.typeprocedures.index')->notice('El tipo de trámite se actualizo correctamente', 'success');
    }

    public function destroy($typeprocedure)
    {
        $typeprocedure_exist_procedure = Procedure::where([['typeprocedure_id', '=', $typeprocedure]])->get();

        if($typeprocedure_exist_procedure->count() > 0){
            $this->notice('El tipo de trámite se encuentra en uso actualmente', 'info');
        } else {
            Typeprocedure::where('id', $typeprocedure)->delete();
            $this->typeprocedure->requirements()->sync([]);
            return redirect()->route('admin.typeprocedures.index')->notice('Se eliminó el tipo de trámite correctamente', 'alert');
        }
    }

    public function render()
    {
        return view('livewire.admin.typeprocedures.update-form');
    }
}
