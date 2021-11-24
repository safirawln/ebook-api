<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

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

//Routes Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Routes Group Middleware
Route::group(['middleware' => ['auth:sanctum']], function () {

    //Routes User and Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [AuthController::class, 'me']);

    //Routes Books
    Route::get('books', 'BookController@index');
    Route::post('books', 'BookController@store');
    Route::get('books/{id}', 'BookController@show');
    Route::put('books/{id}', 'BookController@update');
    Route::delete('books/{id}', 'BookController@destroy');

    //Routes Authors
    Route::get('authors', 'AuthorController@index');
    Route::post('authors', 'AuthorController@store');
    Route::get('authors/{id}', 'AuthorController@show');
    Route::put('authors/{id}', 'AuthorController@update');
    Route::delete('authors/{id}', 'AuthorController@destroy');
});
