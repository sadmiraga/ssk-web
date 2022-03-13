<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\GuestController::class, 'index'])->name('index');

Route::get('/dogodki', [App\Http\Controllers\EventsController::class, 'index'])->name('events.index');
Route::get('/dodaj-dogodek', [App\Http\Controllers\EventsController::class, 'create'])->name('events.create');
Route::post('/dodaj-dogodek-exe', [App\Http\Controllers\EventsController::class, 'store'])->name('events.store');

Route::get('/forme', [App\Http\Controllers\FormsController::class, 'index'])->name('forms.index');
Route::get('/dodaj-formo', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.create');
Route::post('/dodaj-formo-exe', [App\Http\Controllers\FormsController::class, 'store'])->name('forms.store');

Route::get('/uredi-formo{formID}', [App\Http\Controllers\FormsController::class, 'edit'])->name('forms.edit');
Route::post('/uredi-formo', [App\Http\Controllers\FormsController::class, 'storeEdit'])->name('forms.storeEdit');




Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
