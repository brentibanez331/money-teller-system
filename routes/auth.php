<?php
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'index']);
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'register'])->name('register.account');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/phonebook', function () {
//         return view('phonebook/index');
//     });
//     Route::get('/phonebook', [PhonebookController::class, 'index'])->name('phonebook.index');
//     Route::post('/store', [PhonebookController::class, 'store'])->name('phonebook.store');
//     Route::get('/edit/{id}', [PhonebookController::class, 'edit'])->name('phonebook.edit');
//     Route::put('/update', [PhonebookController::class, 'update'])->name('phonebook.update');
//     Route::get('/delete/{id}', [PhonebookController::class, 'delete'])->name('phonebook.delete');

//     Route::post('logout', [AuthenticationController::class, 'destroy'])
//                 ->name('logout');    
// });

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin/index');
    });
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('/admin-users', [UserController::class, 'adminusers'])->name('admin.users');

    //Dont change
    Route::post('/store', [UserController::class, 'store'])->name('phonebook.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('phonebook.edit');
    Route::put('/update', [UserController::class, 'update'])->name('phonebook.update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('phonebook.delete');

    Route::post('logout', [AuthenticationController::class, 'destroy'])
                ->name('logout');    
});

Route::middleware('auth')->group(function () {
    Route::get('/teller', function () {
        return view('teller/index');
    });
    Route::get('/teller', [UserController::class, 'index'])->name('teller.index');
    // Route::get('/admin-users', [UserController::class, 'index'])->name('admin.users');

    //Dont change
    Route::post('/store', [UserController::class, 'store'])->name('phonebook.store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('phonebook.edit');
    Route::put('/update', [UserController::class, 'update'])->name('phonebook.update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('phonebook.delete');

    Route::post('logout', [AuthenticationController::class, 'destroy'])
                ->name('logout');    
});