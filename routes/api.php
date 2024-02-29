<?php

use App\Http\Controllers\API\RouteController;
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

Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('contact/list', [RouteController::class, 'contactList']);
Route::get('order/list', [RouteController::class, 'orderList']);
Route::get('orderLists/list', [RouteController::class, 'orderLists']);
Route::get('user/list', [RouteController::class, 'userList']);


// post

Route::post('category/create', [RouteController::class, 'categoryCreate']);
Route::post('contact/create', [RouteController::class, 'contactCreate']);
Route::post('contact/delete', [RouteController::class, 'contactDelete']);
Route::get('contact/detail/{id}', [RouteController::class, 'contactDetail']);
Route::post('category/update', [RouteController::class, 'categoryUpdate']);


/**
 * prodcut list
 * localhost: 8000/api/product/list (GET)
 * category list
 * localhost: 8000/api/category/list (GET)
 *
 * create category localhost: 8000/api/create/category (POST)
 * body{
 *    name:
 * }

 * }
 * localhost: 8000/api/category/delete/fid} (GET)
 * localhost: 8000/api/category/delete/{id} (GET)
 **/
