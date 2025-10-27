<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('home');




use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'admin']);
Route::get('/admin/login', [AdminController::class, 'showLogin']);
Route::post('/admin/login', [AdminController::class, 'doLogin']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::delete('/admin/brochure/{id_service}/delete', [AdminController::class, 'deletebrochure'])
    ->name('admin.brochure.delete');
Route::post('/admin/addbrochures', [AdminController::class, 'addbrochures'])
    ->name('service.addbrochures');
