<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.areas.index')->only('index');
    $this->middleware('can:admin.areas.create')->only('create', 'store');
    $this->middleware('can:admin.areas.edit')->only('edit', 'update');
    $this->middleware('can:admin.areas.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.areas.index');
  }

  public function create()
  {
    return view('admin.areas.create');
  }

  public function edit(Area $area)
  {
    return view('admin.areas.edit');
  }
}
