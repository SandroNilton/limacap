<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.create')->only('create', 'store');
        $this->middleware('can:admin.roles.edit')->only('edit', 'update');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }

    public function index(): view
    {
        return view('admin.roles.index');
    }

    public function create(): view
    {
        return view('admin.roles.create');
    }

    public function edit(Role $role): view
    {
        return view('admin.roles.edit', compact('role'));
    }
}
