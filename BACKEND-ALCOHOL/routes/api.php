<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AlcoholGenreMaster;
use App\Models\Question;
use App\Models\AlcoholMaster;

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
    $genre = AlcoholGenreMaster::where('id', '=', $id)
        ->select('id', 'name', 'image')
        ->first();

    $questions = Question::where('genre_id', '=', $id)
        ->with('questionChoices')
        ->get();
    return response()->json([
        'genre' => $genre,
        'questions' => $questions
    ]);
})->middleware('auth:sanctum');

Route::post('/result', function (Request $request) {
    $results = AlcoholMaster::where('genre_id', '=', $request->genre_id)
        ->select('id', 'name', 'image', 'genre_id', 'description', 'min_score', 'max_score')
        ->where('min_score', '<=', $request->total_score)
        ->where('max_score', '>=', $request->total_score)
        ->get();
    return response()->json($results);
});