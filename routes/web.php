<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// crud user
Route::group(['prefix' =>'users','middleware' => "auth"],function(){
    Route::get('all-user',[UserController::class,'index'])->name('user-all');
    Route::post('store-user',[UserController::class,'store'])->name('user-store');
    Route::post('update/{id}',[UserController::class,'update'])->name('user-update');
    Route::post('delete/{id}',[UserController::class,'delete'])->name('user.delete');
});

require __DIR__.'/auth.php';
