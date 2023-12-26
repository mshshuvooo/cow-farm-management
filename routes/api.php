<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CowController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['web'],], function () {
    Route::post('login', [LoginController::class, 'store']);
    Route::get('loggedin-user', function() {
        return response()->json(['user' => auth()->user()]);
    });
});
Route::group(['middleware' => ['auth:sanctum', 'web'],], function () {
    Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');
    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{user}', [UserController::class, 'update']);
});


Route::middleware('auth:sanctum')->group( function() {

});
Route::get("/cows", [CowController::class,"index"]);

Route::post("/cows", [CowController::class,"store"]);
