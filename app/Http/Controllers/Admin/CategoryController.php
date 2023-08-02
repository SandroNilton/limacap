<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:admin.categories.index')->only('index');
    $this->middleware('can:admin.categories.create')->only('create', 'store');
    $this->middleware('can:admin.categories.edit')->only('edit', 'update');
    $this->middleware('can:admin.categories.destroy')->only('destroy');
  }

  public function index()
  {
    return view('admin.categories.index');
  }

  public function create()
  {
    return view('admin.categories.create');
  }

  public function edit(Category $category)
  {
    return view('admin.categories.edit');
  }
}
