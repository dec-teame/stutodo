<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Google 認証後の処理
        // あとで処理を追加しますが、とりあえず dd() で取得するユーザー情報を確認
        $gUser = Socialite::driver('google')->stateless()->user();
        dd($gUser);
    }
    public function callback()
    {
        $_ = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $_->email)->first(); // 認証プロバイダからの戻り値から、アプリケーションのログインIDを取得する

        if (!empty($user)) {
            Auth::loginUsingId($user->id);      // ログインIDのみでアプリケーションにログインする。
            return redirect($this->redirectTo); // ログイン後のリダイレクト
        }

        $request = new Request;
        $request->merge([
            'name' => $_->name,
            'email' => $_->email,
        ]);

        $regist = new RegisterController;
        return $regist->register($request);
    }
}
