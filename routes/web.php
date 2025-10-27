<?php

use Illuminate\Support\Facades\Route;
use app\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});
