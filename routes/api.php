<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FeedBackController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::middleware('auth:api')->get('authenticated-user-details', [ApiAuthController::class, 'authenticatedUserDetails']);
    Route::post('login', [ApiAuthController::class, 'login']);
});
Route::prefix('data')->group(function () {
    Route::middleware('auth:api')->get('courses/myassignments', [CoursesController::class, 'MyAssignments']);
    Route::middleware('auth:api')->get('courses/mycourses', [CoursesController::class, 'MyCourses']);
    Route::middleware('auth:api')->get('courses/popularcourses', [CoursesController::class, 'MyCourses']);
    Route::middleware('auth:api')->post('feedback', [FeedBackController::class, 'FeedBack']);
    //Route::get('courses', [CoursesController::class, 'Courses']);
});
