<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\FunctionaryTypeController;
use App\Http\Controllers\DelegationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FunctionaryController;
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

Route::get('auth/twitter', [TwitterController::class, 'loginwithTwitter']);
Route::get('auth/callback/twitter', [TwitterController::class, 'cbTwitter']);

Auth::routes();

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/search',[HomeController::class,'search'])->name('search');

Route::get('functionary_types',[FunctionaryTypeController::class,'index']);
Route::get('delegations/{id}/list',[DelegationController::class,'index']);
Route::get('locations/{id}/list',[LocationController::class,'index']);
Route::get('functionaries_search',[FunctionaryController::class,'index']);
Route::get('functionary/{id}/detail',[HomeController::class,'functionary']);
Route::get('functionary/{id}/activities',[HomeController::class,'functionary_activities']);
Route::get('functionary/{id}/projects',[HomeController::class,'functionary_projects']);
Route::get('functionary/{id}/laws',[HomeController::class,'functionary_laws']);
Route::get('functionary/{id}/proposals',[HomeController::class,'functionary_proposals']);

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::resource('levels.functionary_types', FunctionaryTypeController::class);
});
