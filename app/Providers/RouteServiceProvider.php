<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            //Masters Routes
            Route::middleware('web')
                ->group(base_path('routes/master.php'));
            //OPD Routes
            Route::middleware('web')
                ->group(base_path('routes/opd.php'));
            //PHARMACY Routes
            Route::middleware('web')
                ->group(base_path('routes/pharmacy.php'));
            //Service Module Routes
            Route::middleware('web')
                ->group(base_path('routes/service.php'));
            //IPD/NURSING/ORGANIZATION Routes
            Route::middleware('web')
                ->group(base_path('routes/ipd.php'));
            //PATHOLOGY Routes
            Route::middleware('web')
                ->group(base_path('routes/pathology.php'));
            Route::middleware('web')
                ->group(base_path('routes/nurse.php'));
            Route::middleware('web')
                ->group(base_path('routes/ot.php'));
            Route::middleware('web')
                ->group(base_path('routes/blood-bank.php'));
            Route::middleware('web')
                ->group(base_path('routes/report.php'));
        });
    }
}
