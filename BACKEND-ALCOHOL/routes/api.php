<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AlcoholGenreMaster;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    return User::all();
})->middleware('auth:sanctum');

Route::get('/genre', function (Request $request) {
    return AlcoholGenreMaster::all();
})->middleware('auth:sanctum');