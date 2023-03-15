<?php

use App\Http\Controllers\CompetitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('competitions')->group(function () {
    Route::get('/', [
        CompetitionController::class,
        'getCompetitions'
    ]);

    Route::get('/{competition}', [
        CompetitionController::class,
        'getCompetition'
    ]);

    Route::post('/', [
        CompetitionController::class,
        'createCompetition'
    ]);

    Route::post('/{competition}/player', [
        CompetitionController::class,
        'addPlayerToCompetition'
    ]);

    Route::post('/{competition}/player/{player}', [
        CompetitionController::class,
        'incrementPlayerScoreInCompetition'
    ]);
});
