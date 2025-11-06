<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/HikariDenki', fn () => view('HikariDenki'))->name('HikariDenki');

Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/brochures/{file}', [ServiceController::class, 'showPdf'])
    ->name('brochures.show');

// ถ้าอยากให้ /Service ตัว S ใหญ่ก็เข้าได้ด้วย
Route::get('/Service', function () {
    return redirect()->route('service.index');
});
Route::get('/about', fn () => view('about'))->name('about');


use App\Http\Controllers\AdminController;
Route::get('/admin', [AdminController::class, 'admin']);
Route::get('/admin/login', [AdminController::class, 'showLogin']);
Route::post('/admin/login', [AdminController::class, 'doLogin']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::delete('/admin/brochure/{id_service}/delete', [AdminController::class, 'deletebrochure'])
    ->name('admin.brochure.delete');
Route::post('/admin/addbrochures', [AdminController::class, 'addbrochures'])
    ->name('service.addbrochures');
