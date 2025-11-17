<?php

namespace App\Providers;

use App\Enums\Token;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(CarbonInterval::days(Token::TOKEN_TTL_DAYS->value));
        Passport::refreshTokensExpireIn(CarbonInterval::days(Token::REFRESH_TOKEN_TTL_DAYS->value));
        Passport::personalAccessTokensExpireIn(CarbonInterval::months(6));
    }
}
