<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Typeprocedure;

class TypeprocedureController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.typeprocedures.index')->only('index');
    $this->middleware('can:admin.typeprocedures.create')->only('create', 'store');
    $this->middleware('can:admin.typeprocedures.edit')->only('edit', 'update');
    $this->middleware('can:admin.typeprocedures.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.typeprocedures.index');
  }

  public function create()
  {
    return view('admin.typeprocedures.create');
  }

  public function edit(Typeprocedure $typeprocedure)
  {
    return view('admin.typeprocedures.edit');
  }
}
