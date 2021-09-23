<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('app')->group(function(){
    Route::post('/create_role/{roleName}', [AdminController::class, 'createRole']);
    Route::get('/get_roles', [AdminController::class, 'getRoles']);
    Route::get('/get_users', [AdminController::class, 'getUsers']);
    Route::post('/create_user', [AuthController::class, 'createUser']);
    Route::post('/verify/{phone}/{verification_code}', [AuthController::class, 'verify']) ;
    Route::post('/request_code/{phone}', [AuthController::class, 'requestCode']) ;
    Route::post('/login', [AuthController::class, 'login']) ;
});

Route::get('/logout',[AuthController::class, 'logout']);

Route::get('/',[HomeController::class, 'index']);
Route::any('{slug}', [HomeController::class, 'index'])->where('slug', '([A-z\d\-\/_.]+)?');


