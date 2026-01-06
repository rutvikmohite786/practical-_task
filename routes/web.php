<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataController;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UserDataController::class, 'index'])->name('home');
    Route::get('/users/data', [UserDataController::class, 'getData'])->name('users.getData');
    Route::post('/users', [UserDataController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserDataController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserDataController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/bulk-delete', [UserDataController::class, 'bulkDestroy'])->name('users.bulkDestroy');
    Route::get('/categories', [UserDataController::class, 'getCategories'])->name('categories.get');
    Route::get('/hobbies', [UserDataController::class, 'getHobbies'])->name('hobbies.get');
});
