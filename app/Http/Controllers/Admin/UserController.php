<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.users.index')->only('index');
    $this->middleware('can:admin.users.create')->only('create', 'store');
    $this->middleware('can:admin.users.edit')->only('edit', 'update');
    $this->middleware('can:admin.users.destroy')->only('destroy');
  }

  public function index(): view
  {
    return view('admin.users.index');
  }

  public function create(): view
  {
    return view('admin.users.create');
  }

  public function edit(User $user): view
  {
    return view('admin.users.edit', compact('user'));
  }
}
