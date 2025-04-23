<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Alcohol_Genre_Master;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    return User::all();
})->middleware('auth:sanctum');

Route::get('/genre', function (Request $request) {
    return Alcohol_Genre_Master::all();
})->middleware('auth:sanctum');