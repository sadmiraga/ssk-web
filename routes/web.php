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

Auth::routes();


//direktor routes
Route::middleware(['direktorMiddleware'])->group(function () {

    //ZAPOSLENI
    Route::get('/zaposleni', [App\Http\Controllers\UsersController::class, 'index'])->name('employees.index');
    Route::get('/uredi-zaposlenega/{user_id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('employees.edit');
    Route::post('/uredi-zaposlenega', [App\Http\Controllers\UsersController::class, 'update'])->name('employees.update');

    //URE
    Route::get('/poglej-ure/{userID}', [App\Http\Controllers\ShiftsController::class, 'viewShifts'])->name('hours.view');
    Route::get('/prenesi-ure/{userID}/{yearMonth}', [App\Http\Controllers\ShiftsController::class, 'downloadExcel'])->name('hours.download');
});

//operativc
Route::middleware(['operativcMiddleware'])->group(function () {

    //URE
    Route::get('/ure', [App\Http\Controllers\ShiftsController::class, 'myShifts'])->name('hours.myhours');
    Route::get('/dodaj-uro', [App\Http\Controllers\ShiftsController::class, 'newShift'])->name('hours.add');
    Route::post('/dodaj-ure-store', [App\Http\Controllers\ShiftsController::class, 'storeShift']);
    Route::get('/prenesi-moje-ure/{yearMonth}', [App\Http\Controllers\ShiftsController::class, 'downloadMyHours']);


    //DOGODKI
    Route::get('/dogodki/{status}', [App\Http\Controllers\EventsController::class, 'index'])->name('events.index');
    Route::get('/dodaj-dogodek', [App\Http\Controllers\EventsController::class, 'create'])->name('events.create');
    Route::post('/dodaj-dogodek-exe', [App\Http\Controllers\EventsController::class, 'store'])->name('events.store');
    Route::get('/izbrisi-dogodek/{eventID}', [App\Http\Controllers\EventsController::class, 'delete'])->name('events.delete');
    Route::get('/uredi-dogodek/{eventID}', [App\Http\Controllers\EventsController::class, 'edit'])->name('events.edit');
    Route::post('/uredi-dogodek', [App\Http\Controllers\EventsController::class, 'storeEdit'])->name('events.edit.store');

    //FORME
    Route::get('/forme', [App\Http\Controllers\FormsController::class, 'index'])->name('forms.index');
    Route::get('/dodaj-formo', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.create');
    Route::post('/dodaj-formo-exe', [App\Http\Controllers\FormsController::class, 'store'])->name('forms.store');
    Route::get('/pogledaj-formu/{form_id}', [App\Http\Controllers\FormsController::class, 'previewForm'])->name('forms.preview');
    Route::get('/doloci-formo/{eventID}', [App\Http\Controllers\EventsController::class, 'setForm'])->name('events.setForm');
    Route::post('/setFormExe', [App\Http\Controllers\EventsController::class, 'setFormExe'])->name('events.setFormExe');
    Route::get('/izbrisi-formo/{formID}', [App\Http\Controllers\FormsController::class, 'delete'])->name('forms.delete');
    Route::get('/uredi-formo/{formID}', [App\Http\Controllers\FormsController::class, 'edit'])->name('forms.edit');
    Route::post('/uredi-formo', [App\Http\Controllers\FormsController::class, 'storeEdit'])->name('forms.storeEdit');
    Route::get('/odstrani-input/{form_id}/{field_name}', [App\Http\Controllers\FormsController::class, 'removeInput'])->name('forms.removeInput');

    //NAROCNIKI
    Route::get('/narocniki', [App\Http\Controllers\SubscribersController::class, 'index'])->name('subscribers.index');
    Route::get('/izbrisi-narocnika/{email}', [App\Http\Controllers\SubscribersController::class, 'delete'])->name('subscribers.delete');
    Route::get('/narocniki/{email}/zgodovina-prijav', [App\Http\Controllers\SubscribersController::class, 'applicationHistory'])->name('subscribers.applicationHistory');
    Route::get('/povabi-narocnike/{eventID}', [App\Http\Controllers\SubscribersController::class, 'inviteSubscriber'])->name('events.invite-subscriber');
    Route::post('/poslji-emaile', [App\Http\Controllers\SubscribersController::class, 'sendInvitations'])->name('subscribers.send-email');
});


//public routes
Route::get('/', [App\Http\Controllers\GuestController::class, 'index'])->name('index');
Route::get('/dogodek/{eventID}', [App\Http\Controllers\EventsController::class, 'single'])->name('events.single');
Route::get('/prijava/{eventID}', [App\Http\Controllers\GuestController::class, 'apply'])->name('event.apply');
Route::post('/prijava', [App\Http\Controllers\GuestController::class, 'saveApply']);
Route::get('/odjava', [App\Http\Controllers\basicController::class, 'odjava'])->name('functions.logout');
