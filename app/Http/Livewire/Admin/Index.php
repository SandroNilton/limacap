<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Models\Typeprocedure;
use App\Models\Requirement;
use App\Models\Procedure;
use Livewire\Component;

class Index extends Component
{
  public $areas;
  public $categories;
  public $roles;
  public $users;
  public $customers;
  public $typeprocedures;
  public $requirements;
  public $procedures;

  public function render()
  {
    $this->areas = Area::all()->count();
    $this->categories = Category::all()->count();
    $this->roles = Role::all()->count();
    $this->users = User::all()->count();
    $this->customers_natural = User::where('type', '=', 'natural')->count();
    $this->customers_juridico = User::where('type', '=', 'juridico')->count();
    $this->customers_agremiado = User::where('type', '=', 'agremiado')->count();
    $this->typeprocedures = Typeprocedure::all()->count();
    $this->requirements = Requirement::all()->count();
    $this->procedures = Procedure::all()->count();
    return view('livewire.admin.index');
  }
}
