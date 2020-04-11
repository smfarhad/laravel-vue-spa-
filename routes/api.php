<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@likeIt');
Route::delete('/like/{reply}', 'LikeController@unLikeIt');

Route::post('/auth/login', 'API\AuthController@login');
Route::post('/auth/register', 'API\AuthController@register');

Route::post('/notifications', 'NotificationController@index');
Route::post('/markAsRead', 'NotificationController@markAsRead');

Route::group([
    'middleware' => 'jwt',
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('me', 'API\AuthController@me');
});
