<?php

namespace App\Http\Livewire\App\Procedures;

use App\Models\Category;
use App\Models\Typeprocedure;
use App\Models\Procedurehistory;
use App\Models\Fileprocedure;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterForm extends Component
{

    public $categories;
    public $typeprocedures;
    public $requirements;
    public $description;
    public $files = [];
    public $selectedCategory = NULL;
    public $selectedTypeprocedure = NULL;
    public $typeproceduredata;
    public $categorydata;

    public function updatedselectedCategory($categoryid)
    {
      if(is_null($categoryid) || empty($categoryid)){
        $this->selectedTypeprocedure = NULL;
      }else{
        $this->typeprocedures = Typeprocedure::where([['category_id', $categoryid], ['state', '=', 'activo']])->get();
        $this->reset('selectedTypeprocedure');
        $this->selectedTypeprocedure = "";
        $this->categorydata = Category::where([['id', '=', $categoryid]])->get();
      }
    }

    public function updatedselectedTypeprocedure($typeprocedureid)
    {
      if (is_null($typeprocedureid) || empty($typeprocedureid)) {
        $this->requirements = NULL;
      }else{
        $this->requirements = DB::table('requirement_typeprocedure')
          ->join('requirements', 'requirement_typeprocedure.requirement_id', '=', 'requirements.id')
          ->join('typeprocedures', 'requirement_typeprocedure.typeprocedure_id', '=', 'typeprocedures.id')
          ->where([['requirement_typeprocedure.typeprocedure_id', '=', $typeprocedureid], ['requirements.state', '=', 'activo']])
          ->select('requirements.*')->get();
        $this->typeproceduredata = Typeprocedure::where([['id', '=', $typeprocedureid]])->get();
      }
    }

    public function render()
    {
        $this->categories = Category::where([['state', '=', 'activo']])->get();
        return view('livewire.app.procedures.register-form');
    }
}
