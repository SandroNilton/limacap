<?php

namespace App\Http\Livewire\Admin\Typeprocedures;

use App\Models\Area;
use App\Models\Category;
use App\Models\Typeprocedure;
use Illuminate\Support\Str;
use Livewire\Component;

class RegisterForm extends Component
{
    public $areas;
    public $categories;

    public $name = '';
    public $area;
    public $category;
    public $requirements = [];
    public $price = '0.00';
    public $description = '';
    public $state = "Activo";

    protected $rules = [
        'name' => 'required',
        'area' => 'required',
        'category' => 'required',
    ];

    public function mount(): void
    {
        $this->areas = Area::where('state', '=', 'Activo')->get();
        $this->categories = Category::where('state', '=', 'Activo')->get();
    }

    public function updated($fields): void
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->validate();
        $type_procedure = Typeprocedure::create([
          'name' => Str::upper($this->name),
          'area_id' => $this->area,
          'category_id' => $this->category,
          'description' => $this->description,
          'price' => $this->price,
          'state' => $this->state
        ]);
        $type_procedure->requirements()->sync($this->requirements);
        return redirect()->route('admin.typeprocedures.index')->notice('El tipo de trámite se creo correctamente', 'success');
    }

    public function render()
    {
        return view('livewire.admin.typeprocedures.register-form');
    }
}
