<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/get",[ApiController::class, 'show'])->name("show");
Route::post("/store",[ApiController::class, 'store'])->name("store");
Route::post("/update/{id}",[ApiController::class, 'update'])->name("update");
Route::post("/delete/{id}",[ApiController::class, 'delete'])->name("delete");
Route::get("/search/{email}",[ApiController::class, 'search'])->name("search");














//Route::get("/get", [ApiController::class,'getData']);
