<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.customers.index')->only('index');
    $this->middleware('can:admin.typeprocedures.create')->only('create', 'store');
    $this->middleware('can:admin.typeprocedures.edit')->only('edit', 'update');
    $this->middleware('can:admin.typeprocedures.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.customers.index');
  }

  public function edit(User $customer)
  {
    return view('admin.customers.edit');
  }
}
