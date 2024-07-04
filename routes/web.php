<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TodoCategoryController;


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

Route::get('/about', function () {
    return view('about');
});

Route::prefix('user')->group(function () {
    Route::get('/register', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login/auth', [UserController::class, 'loginAuth']);
    Route::post('/register/store', [UserController::class, 'storeRegister']);
    Route::post('/logout', [UserController::class, 'logout']);

    // Route untuk read, update, dan delete
    Route::get('/', [UserController::class, 'index']);
    Route::get('/edit/{id}', [UserController::class, 'edit']);
    Route::post('/update/{id}', [UserController::class, 'update']);
    Route::delete('/delete/{id}', [UserController::class, 'destroy']);
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
});

Route::prefix('todo')->group(function () {
    Route::get('/', [TodoController::class, 'index']);
    Route::get('/create', [TodoController::class, 'create']);
    Route::get('/edit/{id}', [TodoController::class, 'edit']);
    Route::get('/delete/{id}', [TodoController::class, 'destroy']);
    Route::post('/store', [TodoController::class, 'store']);
    Route::post('/update/{id}', [TodoController::class, 'update']);
});

Route::prefix('todolist')->group(function () {
    Route::get('/', [TodoListController::class, 'index']);
    Route::get('/delete/{id}', [TodoListController::class, 'destroy']);
    Route::post('/store', [TodoListController::class, 'store']);
    Route::post('/update/{id}', [TodoListController::class, 'update']);
});

Route::resource('todo_categories', TodoCategoryController::class);
Route::resource('todolist', TodoListController::class);
