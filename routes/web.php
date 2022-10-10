<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('administrator');
});
Route::get('/administrator', function () {
    return view('welcome');
});
