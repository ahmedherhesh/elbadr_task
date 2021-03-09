<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ApisController;

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

Route::get('/', [HomeController::class,'homePage']);
Route::get('/login', [AuthController::class,'login']);
Route::post('/login', [AuthController::class,'loginPost'])->name('login');
Route::get('/register', [AuthController::class,'register']);
Route::post('/register',[AuthController::class,'registerPost'])->name('register');
Route::get('/add-item',[ItemController::class,'addItem']);
Route::post('/add-item',[ItemController::class,'addItemPost'])->name('add_item');
Route::get('/get-sub-categories',[CategoriesController::class,'getSubCategories']);
Route::post('/insert-categories',[CategoriesController::class,'insertCategories'])->name('insert_categories');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/items',[ApisController::class,'getItems']);
