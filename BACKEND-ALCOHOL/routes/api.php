<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/login', function (Request $request) {
//     $credentials = $request->validate([
//         'email' => ['required', 'email'],
//         'password' => ['required'],
//     ]);

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate();
//         return response()->json(Auth::user());
//     }
//     return response()->json([], 401);
// });
