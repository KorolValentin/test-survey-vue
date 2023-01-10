<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'] , function () {

    Route::get('/survey', [SurveyController::class, 'survey'])->name('survey');
    Route::get('/results', [SurveyController::class, 'results'])->name('results');
    Route::post('/addResult', [SurveyController::class, 'addResult'])->name('addResult');
    Route::get('/statistic', [SurveyController::class, 'statistic'])->name('statistic');
    Route::get('/users', [SurveyController::class, 'users'])->name('users');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
    return auth()->user();
});
