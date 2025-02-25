<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Utils\PermissionUtil;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan(PermissionUtil::$permissions);
        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(now()->addDays(1));
        Passport::$refreshTokensExpireIn = Carbon::now()->diff(now()->addDays(7));
        Passport::$personalAccessTokensExpireIn = Carbon::now()->diff(now()->addMonths(6));
    }
}
