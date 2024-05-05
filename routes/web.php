<?php

use App\Livewire\Compare\CreateCompare;
use App\Livewire\Compare\ShowCompare;
use App\Livewire\Plan\Create;
use App\Livewire\Plan\Show;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/test', function () {
    return view('test');
});

Route::get('/plan/create', Create::class)->name('plan.create')->middleware('auth');
Route::get('/plan/{plan}/show', Show::class)->name('plan.show');
Route::get('/compare/create', CreateCompare::class)->name('compare.create')->middleware('auth');
Route::get('/compare/show', ShowCompare::class)->name('compare.show')->middleware('auth');
Route::get('/profile', Profile::class)->name('profile')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'plans'])->name('index');
