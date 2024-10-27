<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ユーザー作成に使用するクラスの指定
        Fortify::createUsersUsing(CreateNewUser::class);

        // 登録画面のカスタムビューを指定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン画面のカスタムビュー
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // カスタムルート(登録処理)
        Route::middleware(['web'])->group(function () {
            Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
        });

        // ログインのレート制限設定
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
