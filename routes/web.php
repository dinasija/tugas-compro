<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ServiceController;
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

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/blog',[BlogController::class,'blog'])->name('blog');
Route::get('/blog/detail',[BlogController::class,'detail'])->name('blog_detail');
Route::get('/slider',[HomeController::class,'index'])->name('slider');
Route::get('/services',[HomeController::class,'index'])->name('services');

Route::get('backend/login',[LoginController::class,'index'])->name('backend.login');
Route::get('backend/blog',[BlogController::class,'index'])->name('backend.blog');
Route::get('backend/slider',[SliderController::class,'index'])->name('backend.slider');
Route::get('backend/services',[ServiceController::class,'index'])->name('backend.services');
