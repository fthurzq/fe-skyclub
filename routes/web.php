<?php

use Illuminate\Support\Facades\Route;

Route::get('users/login', function () {
    return view('auth.login');
})->name('login');
Route::get('users/register', function () {
    return view('auth.register');
})->name('register');
Route::get('users/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');
Route::get('users/reset-password', function () {
    return view('auth.set-password');
})->name('reset-password');
Route::get('/', function () {
    return view('index');
});
