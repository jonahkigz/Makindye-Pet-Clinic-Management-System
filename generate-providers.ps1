Write-Host "Creating Laravel default Providers..."

$path = "app\Providers"

# Ensure folder exists
New-Item -ItemType Directory -Force -Path $path | Out-Null

# ---------------------------------------
# AppServiceProvider
# ---------------------------------------
@"
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
"@ | Set-Content "$path\AppServiceProvider.php"

# ---------------------------------------
# AuthServiceProvider
# ---------------------------------------
@"
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected \$policies = [
        //
    ];

    public function boot(): void
    {
        \$this->registerPolicies();
    }
}
"@ | Set-Content "$path\AuthServiceProvider.php"

# ---------------------------------------
# EventServiceProvider
# ---------------------------------------
@"
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected \$listen = [
        //
    ];

    public function boot(): void
    {
        //
    }
}
"@ | Set-Content "$path\EventServiceProvider.php"

# ---------------------------------------
# BroadcastServiceProvider
# ---------------------------------------
@"
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        //
    }
}
"@ | Set-Content "$path\BroadcastServiceProvider.php"

# ---------------------------------------
# RouteServiceProvider
# ---------------------------------------
@"
<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    public function boot(): void
    {
        \$this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/auth.php'));
        });
    }
}
"@ | Set-Content "$path\RouteServiceProvider.php"

Write-Host "All providers created successfully!"
Write-Host "Next run: php artisan optimize:clear"