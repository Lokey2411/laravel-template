<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $users = User::paginate(10);
    return view('welcome', compact('users'));
})->name("home");

Route::resource('users', UserController::class);
Route::post("/search", [UserController::class, "search"])->name("search");
Route::get("/search", [UserController::class, "search"])->name("search");