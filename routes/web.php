<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => 'auth'], function () {
    Route::get('/', [ProductController::class, 'search'])->name('get');
    Route::get('/{code}/detail', [ProductController::class, 'show'])->name('show');
    // Route::post('/store', [StudentController::class, 'store'])->name('store');
    // Route::put('/update', [StudentController::class, 'update'])->name('update');
    // Route::get('/validate-code', [StudentController::class, 'validateCode'])->name('validate-code');
    // Route::delete('/drop', [StudentController::class, 'drop'])->name('drop');
});
