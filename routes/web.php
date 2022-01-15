<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaydrawController;

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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'users' => UsersController::class,
]);

Route::get('/paydraws/index/{id}', [PaydrawController::class, 'index'])->name('paydraws.index');
Route::post('/paydraws', [PaydrawController::class, 'store'])->name('paydraws.store');
Route::get('/paydraws', [PaydrawController::class, 'create'])->name('paydraws.create');
Route::get('/paydraws/charts/{id}', [PaydrawController::class, 'returnClientPaydraws'])->name('paydraws.chart');
