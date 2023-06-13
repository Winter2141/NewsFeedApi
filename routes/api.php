<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\ArticleController;

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


Route::controller(AuthController::class)->prefix("auth")->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::controller(UserSettingController::class)->prefix("user-settings")->group(function () {
    Route::get('/', 'index');
    Route::put('/update/{userSetting}', 'update');
    Route::post('/create', 'create');
});
Route::controller(ArticleController::class)->prefix("article")->group(function () {
    Route::post('/search', 'search');
    Route::post('/increase-view/{article}', 'increaseView');
    Route::get('/countries', 'getCountries');
    Route::get('/languages', 'getLanguages');
    Route::get('/categories', 'getCategories');
    Route::get('/sources', 'getSources');
});
