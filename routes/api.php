<?php

use Illuminate\Http\Request;

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

//------------------------------------------------ Auth --------------------------------------------------------------//

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
//------------------------------------------------ Vacation Requests -------------------------------------------------//

Route::get('vacation/requests', VacationRequestsController::class . "@index");
Route::get('vacation/manager/requests', VacationRequestsController::class . "@showManagerRequests");
Route::get('vacation/hr/requests', VacationRequestsController::class . "@showHrRequests");
Route::post('vacation/requests/create', VacationRequestsController::class . "@create");
Route::post('vacation/manager/request/accept/{id}', VacationRequestsController::class . "@acceptManager");
Route::post('vacation/hr/request/accept/{id}', VacationRequestsController::class . "@acceptHR");
Route::post('vacation/request/reject/{id}', VacationRequestsController::class . "@reject");

//------------------------------------------------ Upload Requests ---------------------------------------------------//
Route::get('upload/requests', UploadRequestsController::class . "@index");
Route::get('upload/manager/requests', UploadRequestsController::class . "@showManagerRequests");
Route::get('upload/hr/requests', UploadRequestsController::class . "@showHrRequests");
Route::post('upload/requests/create', UploadRequestsController::class . "@create");
Route::post('upload/manager/request/accept/{id}', UploadRequestsController::class . "@acceptManager");
Route::post('upload/hr/request/accept/{id}', UploadRequestsController::class . "@acceptHR");
Route::post('upload/request/reject/{id}', UploadRequestsController::class . "@reject");

//------------------------------------------------ Custody Requests --------------------------------------------------//
Route::get('custody/requests', CustodyRequestsController::class . "@index");
Route::get('custody/manager/requests', CustodyRequestsController::class . "@showManagerRequests");
Route::get('custody/hr/requests', CustodyRequestsController::class . "@showHrRequests");
Route::post('custody/requests/create', CustodyRequestsController::class . "@create");
Route::post('custody/manager/request/accept/{id}', CustodyRequestsController::class . "@acceptManager");
Route::post('custody/hr/request/accept/{id}', CustodyRequestsController::class . "@acceptHR");
Route::post('custody/request/reject/{id}', CustodyRequestsController::class . "@reject");

//------------------------------------------------ Employee Custodies ------------------------------------------------//
Route::get('custodies', EmployeeController::class . "@custodies");

Route::get('vacations', EmployeeController::class . "@vacations");

Route::get('uploads', EmployeeController::class . "@uploads");

Route::post('change/password', EmployeeController::class . "@changePassword");

Route::get('user', function(){
   return auth()->user();
});

Route::get('lookup/custodies', function(){
    return \App\Models\Custody::all();
});

Route::get('lookup/vacations', function(){
   return  \App\Models\Vacation::all();
});


