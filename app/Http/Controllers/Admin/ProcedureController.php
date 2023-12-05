<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.procedures.index')->only('index');
        $this->middleware('can:admin.procedures.create')->only('create', 'store');
        $this->middleware('can:admin.procedures.edit')->only('edit', 'update');
        $this->middleware('can:admin.procedures.destroy')->only('destroy');
    }

    public function index(): view
    {
        return view('admin.procedures.index');
    }

    public function edit(Procedure $procedure): view
    {
        return view('admin.procedures.edit', compact('procedure'));
    }
}
