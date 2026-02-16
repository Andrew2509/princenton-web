<?php

namespace App\Providers;

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
        if (\Illuminate\Support\Facades\App::runningInConsole()) {
            return;
        }

        if (env('APP_ENV') !== 'local') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Fix for Vercel read-only filesystem
        if (isset($_SERVER['VERCEL']) || env('VERCEL')) {
            config([
                'filesystems.disks.local.root' => '/tmp/storage/app/private',
                'filesystems.disks.public.root' => '/tmp/storage/app/public',
            ]);
        }

        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');

        $defaultLang = $settings['default_language'] ?? 'en';
        config(['app.locale' => $defaultLang]);
        config(['laravellocalization.defaultLocale' => $defaultLang]);

        \Illuminate\Support\Facades\View::composer('*', function ($view) use ($settings) {
            $view->with('site_settings', $settings);
        });
    }
}
