<?php

use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepositoryController;
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


Route::get('auth/github', [GitHubController::class, 'redirect'])->name('github.login');
Route::get('auth/github/callback', [GitHubController::class, 'callback']);
Route::post('github/token', [GitHubController::class, 'personalToken'])->name('github.personal.token');

Route::get('repositories/', [RepositoryController::class, 'index'])->name('repositories.list');
Route::get('repositories/{username}', [RepositoryController::class, 'show'])->name('repositories.show');


require __DIR__.'/auth.php';
