<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AlcoholGenreMaster;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function () {
    return User::all();
})->middleware('auth:sanctum');

Route::get('/genres', function () {
    return AlcoholGenreMaster::all();
})->middleware('auth:sanctum');

Route::get('/genre/{id}', function ($id) {
    $genre = AlcoholGenreMaster::where('id','=', $id)
        ->select('id', 'name', 'image')
        ->first();
    return response()->json($genre);
})->middleware('auth:sanctum');
