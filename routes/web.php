<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TokenController;
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

Route::get('/tokens', function (Request $request) {
    // TODO fix this
    // return view('token', ['tokens'=>auth()->user()->tokens]);
    return view('token', ['tokens'=>"TEST"]);
})->middleware(['auth', 'verified'])->name('token');

 
Route::post('/tokens/create', function (Request $request) {
    // TODO: accept custom token names
    $token = auth()->user()->createToken("test");
 
    return ['token' => $token->plainTextToken];
})->middleware(['auth', 'verified']);

Route::delete('/tokens/delete', function (Request $request) {
    auth()->user()->tokens()->delete();
    return;
})->middleware(['auth', 'verified']);

Route::post('token', [TokenController::class, 'create'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
