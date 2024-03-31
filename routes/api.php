<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::post('/login', 'App\Http\Controllers\v1\Auth\AuthController@actionLoginUser')->name('login');
    Route::post('/password', 'App\Http\Controllers\v1\Auth\AuthController@actionChangePassword');

    Route::post('/check-code', 'App\Http\Controllers\v1\ExamController@actionCheckCode');
    Route::post('/start', 'App\Http\Controllers\v1\ExamController@actionStartExam');
    Route::post('/end', 'App\Http\Controllers\v1\ExamController@actionEndExam');

    Route::middleware('jwtAuth')->group(function () {
        Route::get('/me', 'App\Http\Controllers\v1\Auth\AuthController@actionCheckUser');
        Route::get('/logout', 'App\Http\Controllers\v1\Auth\AuthController@actionLogoutUser');

        Route::get('/workers', 'App\Http\Controllers\v1\WorkersController@index');
        // Route::post('/worker', 'App\Http\Controllers\v1\WorkersController@searchWorker');
        Route::post('/workers', 'App\Http\Controllers\v1\WorkersController@create');
        Route::delete('/workers/{id}', 'App\Http\Controllers\v1\WorkersController@destroy');

        Route::get('/groups', 'App\Http\Controllers\v1\GroupsController@index');
        Route::post('/groups', 'App\Http\Controllers\v1\GroupsController@create');
        Route::delete('/groups/{id}', 'App\Http\Controllers\v1\GroupsController@destroy');

        Route::post('/exam', 'App\Http\Controllers\v1\ExamController@create');
        Route::delete('/exam/{id}', 'App\Http\Controllers\v1\ExamController@destroy');

        Route::prefix('results')->group(function () {
            Route::get('/all', 'App\Http\Controllers\v1\ExamController@index');
            Route::get('/worker/{id}', 'App\Http\Controllers\v1\ExamController@getResWorker');
            Route::get('/groups/{id}', 'App\Http\Controllers\v1\ExamController@action');
            Route::get('/org/{id}', 'App\Http\Controllers\v1\ExamController@action');

            Route::prefix('download')->group(function () {
                Route::get('/worker/{id}', 'App\Http\Controllers\v1\PdfController@resultWorker');
                Route::get('/groups/{id}', 'App\Http\Controllers\v1\PdfController@resultGroup');
                Route::get('/org/{id}', 'App\Http\Controllers\v1\PdfController@resultOrg');
            });
        });
        Route::get('/orgs', 'App\Http\Controllers\v1\OrgController@index');
        Route::get('/access-codes/{id}', 'App\Http\Controllers\v1\PdfController@pdfAccessCodes');
    });

    Route::post('/practice', 'App\Http\Controllers\v1\ExamController@actionStartPractice');
});
