<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.users.index')->only('index');
    $this->middleware('can:admin.users.create')->only('create', 'store');
    $this->middleware('can:admin.users.edit')->only('edit', 'update');
    $this->middleware('can:admin.users.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.users.index');
  }

  public function create()
  {
    return view('admin.users.create');
  }

  public function edit(User $user)
  {
    return view('admin.users.edit');
  }
}
