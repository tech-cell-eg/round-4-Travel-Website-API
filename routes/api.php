<?php

use App\Http\Controllers\Api\ActivityController;
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


Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/activities/destination/{destinationId}', [ActivityController::class, 'byDestination'])->name('activities.byDestination');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
