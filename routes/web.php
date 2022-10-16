<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CalendarController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('todo/finishedList', [TodoController::class, 'finishedList'])->name('todo.finishedList');
    //タスク完了ボタンのURL
    Route::post('todo/{todo}/finished', [TodoController::class, 'finished'])->name('todo.finished');
    Route::resource('todo', TodoController::class);
    // Route::get('calendar', function(){return view('calendar');});
    // 下のnameは、RouteIsで使用する。
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
    //googleカレンダー用
    Route::get('/api', 'ApiTestController@test')->name('api.test');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
