<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;

class RequirementController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.requirements.index')->only('index');
    $this->middleware('can:admin.requirements.create')->only('create', 'store');
    $this->middleware('can:admin.requirements.edit')->only('edit', 'update');
    $this->middleware('can:admin.requirements.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.requirements.index');
  }

  public function create()
  {
    return view('admin.requirements.create');
  }

  public function edit(Requirement $requirement)
  {
    return view('admin.requirements.edit');
  }
}
