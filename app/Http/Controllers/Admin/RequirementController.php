<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.requirements.index')->only('index');
        $this->middleware('can:admin.requirements.create')->only('create', 'store');
        $this->middleware('can:admin.requirements.edit')->only('edit', 'update');
        $this->middleware('can:admin.requirements.destroy')->only('destroy');
    }

    public function index(): view
    {
        return view('admin.requirements.index');
    }

    public function create(): view
    {
        return view('admin.requirements.create');
    }

    public function edit(Requirement $requirement): view
    {
        return view('admin.requirements.edit', compact('requirement'));
    }
}
