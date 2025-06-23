<?php

use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\TravelArticleController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::get('/trending-destinations', [DestinationController::class, 'trending']);
Route::get('/tours', [TourController::class, 'index']);
Route::get('/articles', [TravelArticleController::class, 'index']);
