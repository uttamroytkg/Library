<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('pages.dashboard');
});

Route::resource("/student", StudentController::class);
Route::resource("/book", BookController::class);