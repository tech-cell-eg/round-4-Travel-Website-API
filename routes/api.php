<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::get('/trending-destinations', [DestinationController::class, 'trending']);
Route::get('/tours', [TourController::class, 'index']);
