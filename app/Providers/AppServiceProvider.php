<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        // Rate Limiter khusus untuk Registrasi: Maksimal 5 percobaan pendaftaran per 1 menit per IP
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip())->response(function (Request $request, array $headers) {
                return back()->withErrors([
                    'rate_limit' => 'Terlalu banyak permintaan registrasi dari perangkat Anda. Silakan tunggu 1 menit sebelum mencoba kembali.'
                ])->withInput($request->except('Password', 'Password_confirmation'));
            });
        });
    }
}
