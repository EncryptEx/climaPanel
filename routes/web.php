<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('token', ['tokens'=>auth()->user()->tokens]);
    
})->middleware(['auth', 'verified'])->name('tokens');

 
Route::post('/tokens/create', function (Request $request) {
    // TODO: accept custom token names
    $validated = $request->validate([
        'token_name' => 'required|max:255',
    ]);
    $tokens=auth()->user()->tokens;
    $nwtkn = auth()->user()->createToken($validated['token_name']);
    $newTokenName = $validated['token_name'];
    $newTokenCode = $nwtkn->plainTextToken;
    return view('token', ['tokens'=>$tokens, 'newTokenName'=>$newTokenName, 'newTokenCode'=>$newTokenCode]);

})->middleware(['auth', 'verified'])->name('createToken');

Route::delete('/tokens', function (Request $request) {
    auth()->user()->tokens()->delete();
    return;
})->middleware(['auth', 'verified'])->name('delAllTokens');

Route::delete('/tokens/{id}', function ($id) {
    auth()->user()->tokens()->where('id', $id)->delete();
    return redirect('tokens');
})->middleware(['auth', 'verified'])->name('delToken');

Route::post('token', [TokenController::class, 'create'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
