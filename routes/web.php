<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CalendarController;
use Laravel\Socialite\Facades\Socialite;;

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
    Route::post('todo/{todo}/unfinished', [TodoController::class, 'unfinished'])->name('todo.unfinished');
    Route::resource('todo', TodoController::class);
    // Route::get('calendar', function(){return view('calendar');});
    // 下のnameは、RouteIsで使用する。
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//ログイン用のボタンを置く
Route::get('/', function () {
    return view('google_login');
});

// oauth認証するためのURLにリダイレクトする
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')
        ->scopes(['https://www.googleapis.com/auth/calendar.events'])
        ->with(['access_type' => 'offline'])
        ->redirect();
});

// oauthで飛んできたコードを使ってユーザを認証している
Route::get('/auth/callback', function () {

    // $social_user = Socialite::driver('google')->user();
    // $google_user = GoogleUser::whereGoogleId($social_user->id)->first();
    // $user = ($google_user) ? $google_user->user : new User;
    // if (!$google_user) {
    //     $user->name = $social_user->name;
    //     $user->email = $social_user->email;
    //     $user->password = bcrypt(Str::random(20));
    //     $user->save();

    //     $google_user = new GoogleUser;
    //     $google_user->google_id = $social_user->id;
    //}

    // // アクセストークンとリフレッシュトークンをセットしている
    // $google_user->access_token = $social_user->token;
    // $google_user->refresh_token = $social_user->refreshToken ?? $google_user->refreshToken;
    // $google_user->expires = Carbon::now()->timestamp + $social_user->expiresIn;

    // $user->googleUser()->save($google_user);
    // Auth::login($user);
    return redirect('/dashboard');
});

require __DIR__ . '/auth.php';
