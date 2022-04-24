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


//DOGODKI
Route::get('/dogodki', [App\Http\Controllers\EventsController::class, 'index'])->name('events.index');
Route::get('/dodaj-dogodek', [App\Http\Controllers\EventsController::class, 'create'])->name('events.create');
Route::post('/dodaj-dogodek-exe', [App\Http\Controllers\EventsController::class, 'store'])->name('events.store');
Route::get('/izbrisi-dogodek/{eventID}', [App\Http\Controllers\EventsController::class, 'delete'])->name('events.delete');

Route::get('/uredi-dogodek/{eventID}', [App\Http\Controllers\EventsController::class, 'edit'])->name('events.edit');
Route::post('/uredi-dogodek', [App\Http\Controllers\EventsController::class, 'storeEdit'])->name('events.edit.store');

Route::get('/dogodek/{eventID}', [App\Http\Controllers\EventsController::class, 'single'])->name('events.single');



Route::get('/doloci-formo/{eventID}', [App\Http\Controllers\EventsController::class, 'setForm'])->name('events.setForm');
Route::post('/setFormExe', [App\Http\Controllers\EventsController::class, 'setFormExe'])->name('events.setFormExe');

Route::get('/narocniki', [App\Http\Controllers\SubscribersController::class, 'index'])->name('subscribers.index');

Route::get('/forme', [App\Http\Controllers\FormsController::class, 'index'])->name('forms.index');
Route::get('/dodaj-formo', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.create');
Route::post('/dodaj-formo-exe', [App\Http\Controllers\FormsController::class, 'store'])->name('forms.store');

Route::get('/izbrisi-formo/{formID}', [App\Http\Controllers\FormsController::class, 'delete'])->name('forms.delete');
Route::get('/uredi-formo/{formID}', [App\Http\Controllers\FormsController::class, 'edit'])->name('forms.edit');
Route::post('/uredi-formo', [App\Http\Controllers\FormsController::class, 'storeEdit'])->name('forms.storeEdit');


//public routes
Route::get('/', [App\Http\Controllers\GuestController::class, 'index'])->name('index');
Route::get('/prijava/{eventID}', [App\Http\Controllers\GuestController::class, 'apply'])->name('index');

Route::post('/prijava', [App\Http\Controllers\GuestController::class, 'saveApply']);




Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
