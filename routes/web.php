<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
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
Route::resource("/borrow", BorrowController::class);
Route::get("/borrow-search", [BorrowController::class, "search"]) -> name("borrow.search");
Route::post("/borrow-search-student", [BorrowController::class, "searchStudent"]) -> name("borrow.search-student");
Route::get("/borrow-search-student", [BorrowController::class, "searchStudentGet"]) -> name("borrow.search-student.get");
Route::get("/borrow-assign/{id}", [BorrowController::class, "borrowAssign"]) -> name("borrow.assign");
// Route::post("/borrow-assign", [BorrowController::class, "store"]) -> name("borrow.store");