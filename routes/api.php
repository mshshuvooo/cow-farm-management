<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BreedingBullController;
use App\Http\Controllers\CowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['web'],], function () {
    Route::post('login', [LoginController::class, 'store']);
    Route::get('loggedin-user', function() {
        return response()->json(['user' => Auth::user() !== null ? new UserResource(Auth::user()) : '']);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'web'],], function () {
    Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');
    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::get("/cows", [CowController::class,"index"]);
    Route::post("/cows", [CowController::class,"store"]);
    Route::get("/cows/{cow:ear_tag_no}", [CowController::class,"show"]);
    Route::put('cows/{cow:ear_tag_no}', [CowController::class, 'update']);
    Route::delete('cows/{cow:ear_tag_no}', [CowController::class, 'destroy']);


    Route::get("/vaccines", [VaccineController::class,"index"]);
    Route::post("/vaccines", [VaccineController::class,"store"]);
    Route::put("/vaccines/{vaccine}", [VaccineController::class,"update"]);
    Route::get("/vaccines/{vaccine}", [VaccineController::class,"show"]);
    Route::delete("/vaccines/{vaccine}", [VaccineController::class,"destroy"]);

    Route::get("/breeding-bulls", [BreedingBullController::class,"index"]);
    Route::post("/breeding-bulls", [BreedingBullController::class,"store"]);
    Route::put("/breeding-bulls/{breeding_bull}", [BreedingBullController::class,"update"]);
    Route::get("/breeding-bulls/{breeding_bull}", [BreedingBullController::class,"show"]);
    Route::delete("/breeding-bulls/{breeding_bull}", [BreedingBullController::class,"destroy"]);
});


Route::middleware('auth:sanctum')->group( function() {

});

