<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Typeprocedure;
use Illuminate\Http\Request;

class TypeprocedureController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.typeprocedures.index')->only('index');
    $this->middleware('can:admin.typeprocedures.create')->only('create', 'store');
    $this->middleware('can:admin.typeprocedures.edit')->only('edit', 'update');
    $this->middleware('can:admin.typeprocedures.destroy')->only('destroy');
  }

  public function index(): view
  {
    return view('admin.typeprocedures.index');
  }

  public function create(): view
  {
    return view('admin.typeprocedures.create');
  }

  public function edit(Typeprocedure $typeprocedure): view
  {
    return view('admin.typeprocedures.edit', compact('typeprocedure'));
  }
}
