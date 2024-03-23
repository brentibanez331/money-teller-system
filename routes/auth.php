<?php
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\TransactionFeeController;
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
    Route::get('/admin-branches', [BranchController::class, 'index'])->name('admin.branches');
    Route::get('/admin-fees', [TransactionFeeController::class, 'index'])->name('admin.fees');
    Route::get('/admin-adduser', [BranchController::class, 'getData'])->name('admin.adduser');

    Route::post('/admin-userstore', [UserController::class, 'store'])->name('admin.store');
    Route::get('/userdelete/{id}', [UserController::class, 'delete'])->name('admin.deleteuser');
    Route::get('/useredit/{id}', [UserController::class, 'edit'])->name('admin.edituser');
    Route::put('/userupdate', [UserController::class, 'update'])->name('admin.updateuser');

    Route::get('/admin-addbranch', function () {
        return view('admin/addbranch');
    });

    Route::get('/admin-addrates', function () {
        return view('admin/addrates');
    });

    Route::post('/admin-branchstore', [BranchController::class, 'store'])->name('admin.storebranch');
    Route::get('/branchdelete/{id}', [BranchController::class, 'delete'])->name('admin.deletebranch');
    Route::get('/branchedit/{id}', [BranchController::class, 'edit'])->name('admin.editbranch');
    Route::put('/branchupdate', [BranchController::class, 'update'])->name('admin.updatebranch');

    Route::post('/admin-ratestore', [TransactionFeeController::class, 'store'])->name('admin.storerate');
    Route::get('/ratedelete/{id}', [TransactionFeeController::class, 'delete'])->name('admin.deleterate');
    Route::get('/rateedit/{id}', [TransactionFeeController::class, 'edit'])->name('admin.editrate');
    Route::put('/rateupdate', [TransactionFeeController::class, 'update'])->name('admin.updaterate');

    //Dont change
    // Route::post('/store', [UserController::class, 'store'])->name('phonebook.store');
    // Route::get('/edit/{id}', [UserController::class, 'edit'])->name('phonebook.edit');
    Route::put('/update', [UserController::class, 'update'])->name('phonebook.update');
    // Route::get('/delete/{id}', [UserController::class, 'delete'])->name('phonebook.delete');

    Route::post('logout', [AuthenticationController::class, 'destroy'])
                ->name('logout');    
});

Route::middleware('auth')->group(function () {
    Route::get('/teller', function () {
        return view('teller/index');
    });
    Route::get('/teller', [UserController::class, 'index'])->name('teller.index');
    Route::get('/teller-send', function () {
        return view('teller/send');
    });

    Route::get('/teller-request', function () {
        return view('teller/request');
    });

    Route::get('/teller-contacts', [UserController::class, 'getTellers'])->name('teller.contacts');

    // Route::get('/admin-users', [UserController::class, 'index'])->name('admin.users');

    //Dont change
    Route::post('/store', [UserController::class, 'store'])->name('phonebook.store');
    // Route::get('/edit/{id}', [UserController::class, 'edit'])->name('phonebook.edit');
    Route::put('/update', [UserController::class, 'update'])->name('phonebook.update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('phonebook.delete');

    Route::post('logout', [AuthenticationController::class, 'destroy'])
                ->name('logout');    
});