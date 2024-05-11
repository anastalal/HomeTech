<?php

use App\Livewire\Profile;
use App\Livewire\Plan\Show;
use App\Livewire\Plan\Create;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Compare\ShowCompare;
use Illuminate\Support\Facades\Route;
use App\Livewire\Compare\CreateCompare;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
});



//  a route for creating a plan; it uses a Livewire component and is protected by 'auth' middleware
Route::get('/plan/create', Create::class)->name('plan.create')->middleware('auth');

// a route to show a specific plan using a Livewire component; no middleware specified
Route::get('/plan/{plan}/show', Show::class)->name('plan.show');

// a route for creating a comparison; it uses a Livewire component and is protected by 'auth' middleware
Route::get('/compare/create', CreateCompare::class)->name('compare.create')->middleware('auth');

// a route to show comparison results; uses a Livewire component and is protected by 'auth' middleware
Route::get('/compare/show', ShowCompare::class)->name('compare.show')->middleware('auth');

//  a route for user profiles; uses a Livewire component and is protected by 'auth' middleware
Route::get('/profile', Profile::class)->name('profile')->middleware('auth');



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'plans'])->name('index');
Route::get('/plans', [App\Http\Controllers\HomeController::class, 'plans'])->name('plans');