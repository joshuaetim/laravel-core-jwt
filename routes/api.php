<?php

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    $adminHelper = new AdminHelper();
    $user = $adminHelper->GetAuthUser();
    return response()->json(['data' => $user], 200);
});


Route::get('/home', [HomeController::class, 'home']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function() {

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/redis', [HomeController::class, 'redis']);