<?php

use Illuminate\Support\Facades\Route;


// routes/web.php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function () {
    return view('otp', ['otp' => '123456', 'name' => 'Nguyen Van A']);
});
