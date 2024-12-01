<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrl();
        $this->configureVite();
    }

    /**
     * Configure the application's commands.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction(),
        );
    }

    /**
     * Configure the application's models.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict();

        Model::unguard();
    }

    /**
     * Configure the application's URL.
     */
    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }

    /**
     * Configure the application's Vite.
     */
    private function configureVite(): void
    {
        Vite::usePrefetchStrategy('aggressive');
    }
}
