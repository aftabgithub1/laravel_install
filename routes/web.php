<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

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

if(env('CONFIG', true)) {
    Route::get('/', function() {
        return redirect('/db-config');
    });
} else {
    Route::get('/', function () {
        return view('welcome');
    });
}

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

if(env('CONFIG', true)) {
    Route::get('/step-2', [App\Http\Controllers\ConfigController::class, 'step2']);
    Route::get('/db-config', [App\Http\Controllers\ConfigController::class, 'indexDbConfig']);
    Route::match(['get', 'post'], '/config-db-check', [App\Http\Controllers\ConfigController::class, 'configDbCheck']);
    // Route::match(['get', 'post'], '/config-db-next', [App\Http\Controllers\ConfigController::class, 'configDbNext']);
    Route::get('/finish-config', [App\Http\Controllers\ConfigController::class, 'indexFinishConfig']);
    Route::match(['get', 'post'], '/config-finish', [App\Http\Controllers\ConfigController::class, 'configFinish']);
}

Route::get('/test', function() {
    $query = "SELECT * FROM mysql.user";
    return DB::select($query, []);
});

Route::get('/config-btn', [App\Http\Controllers\ConfigController::class, 'configButton']);