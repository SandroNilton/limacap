<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;

class ProcedureController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.procedures.index')->only('index');
    $this->middleware('can:admin.procedures.create')->only('create', 'store');
    $this->middleware('can:admin.procedures.edit')->only('edit', 'update');
    $this->middleware('can:admin.procedures.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.procedures.index');
  }

  public function edit(Procedure $procedure)
  {
    return view('admin.procedures.edit');
  }
}
