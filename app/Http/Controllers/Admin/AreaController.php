<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.areas.index')->only('index');
        $this->middleware('can:admin.areas.create')->only('create', 'store');
        $this->middleware('can:admin.areas.edit')->only('edit', 'update');
        $this->middleware('can:admin.areas.destroy')->only('destroy');
    }

    public function index(): view
    {
        return view('admin.areas.index');
    }

    public function create(): view
    {
        return view('admin.areas.create');
    }

    public function edit(Area $area): view
    {
        return view('admin.areas.edit', compact('area'));
    }
}
