<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PumpController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\EmployerController;

Route::post('login',[AdministratorController::class, 'login'])->name('administratorLogin');
Route::get('administrators', function(){
    return 'Administrators';
});
Route::get('/dashboard', [AdministratorController::class, 'dashboard']);

Route::get('/employers', [EmployerController::class, 'index']);

Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::put('/companies/{company}', [CompanyController::class, 'update']);
Route::delete('/companies/{company}', [CompanyController::class, 'destroy']);
Route::get('/producers', [ProducerController::class, 'index']);
Route::post('/producers', [ProducerController::class, 'store']);
Route::put('/producers/{producer}', [ProducerController::class, 'update']);
Route::delete('/producers/{producer}', [ProducerController::class, 'destroy']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::get('/types', [TypeController::class, 'index']);
Route::post('/types', [TypeController::class, 'store']);
Route::put('/types/{type}', [TypeController::class, 'update']);
Route::delete('/types/{type}', [TypeController::class, 'destroy']);
Route::get('/pumps', [PumpController::class, 'index']);
Route::post('/pumps', [PumpController::class, 'store']);
Route::put('/pumps/{pump}', [PumpController::class, 'update']);
Route::delete('/pumps/{pump}', [PumpController::class, 'destroy']);
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
