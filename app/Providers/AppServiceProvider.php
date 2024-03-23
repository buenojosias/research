<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

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
        TallStackUi::personalize('card')
            ->block('body', 'px-0');
        TallStackUi::personalize()
            ->button()
            ->block('wrapper.sizes.md', 'text-sm px-3 py-1.5');
    }
}
