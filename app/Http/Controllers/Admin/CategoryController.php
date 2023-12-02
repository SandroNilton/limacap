<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.categories.index')->only('index');
        $this->middleware('can:admin.categories.create')->only('create', 'store');
        $this->middleware('can:admin.categories.edit')->only('edit', 'update');
        $this->middleware('can:admin.categories.destroy')->only('destroy');
    }

    public function index(): view
    {
        return view('admin.categories.index');
    }

    public function create(): view
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category): view
    {
        return view('admin.categories.edit', compact('category'));
    }
}
