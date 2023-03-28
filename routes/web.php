<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/store-todo', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo-edit/{id}', [TodoController::class, 'edit'])->name('todo.create');
    Route::get('/todo-show/{id}', [TodoController::class, 'show'])->name('todo.show');
    Route::get('/todo-delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::post('/update-todo', [TodoController::class, 'update'])->name('todo.update');
    Route::post('/change-todo', [TodoController::class, 'changeStatus'])->name('todo.change_status');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
