<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.customers.index')->only('index');
        $this->middleware('can:admin.customers.create')->only('create', 'store');
        $this->middleware('can:admin.customers.edit')->only('edit', 'update');
        $this->middleware('can:admin.customers.destroy')->only('destroy');
    }

    public function index(): view
    {
        return view('admin.customers.index');
    }

    public function edit(User $customer): view
    {
        return view('admin.customers.edit', compact('customer'));
    }
}
