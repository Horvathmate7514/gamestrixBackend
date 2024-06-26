<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
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

Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/productsPaged', [ProductController::class, 'getProductsWithPage']);
Route::get('/products/{id}', [ProductController::class, 'productsById']);
Route::get('/product/{id}', [ProductController::class, 'productsSingleOne']);




Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgotPassword', [AuthController::class, 'ResetPasswordToken']);
Route::post('/resetPassword', [AuthController::class, 'ResetPassword']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/getAllUser', [UserController::class, 'getAllUser']);
    Route::get('/usersstuff', [UserController::class, 'index']);
    Route::post('/updateProfile', [UserController::class, 'updateProfile']);
    Route::get('/OrdersByUser', [UserController::class, 'getOrdersByUser']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/orders', [OrderController::class,'makeOrder']);

    Route::get('/orderedDetails', [OrderDetailsController::class, 'index']);

    Route::post('/makeProducts', [ProductController::class, 'store']);
    Route::post('/updateProducts/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/deleteProcts/{id}', [ProductController::class, 'destroy']);




});







