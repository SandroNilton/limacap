<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Requirement;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/requirements', function (Request $request) {
  $term = $request->q ?: '';
  $requirements = Requirement::select('id', 'name as text')->where('name', 'like', '%'. $term . '%')->get();
  return $requirements;
  dd($term);
})->name('requirement.select2');

