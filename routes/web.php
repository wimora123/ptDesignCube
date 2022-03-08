<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SubscriptionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', [MainController::class, 'index']);
Route::get('/getRegency', [MainController::class, 'jsonRegency']);
Route::get('/getSubdistrict', [MainController::class, 'jsonSubdistrict']);
Route::get('/getVillage', [MainController::class, 'jsonVillage']);

Route::get('/subscription', [SubscriptionController::class, 'index']);
Route::get('/jsonSubscription', [SubscriptionController::class, 'jsonSubscription']);
Route::post('/inputSubscribe', [SubscriptionController::class, 'insertSubscription']);
Route::delete('/deleteSubs/{id}', [SubscriptionController::class, 'deleteSubscription']);
