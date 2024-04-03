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
            ->block('header.text', 'text-gray-800 font-semibold')
            ->block('body', 'text-gray-900 dark:text-dark-300 grow rounded-b-xl px-4 py-5');
        TallStackUi::personalize()
            ->button()
            ->block('wrapper.sizes.md', 'text-sm px-3 py-1.5');
        TallStackUi::personalize()
            ->tab()
            ->block('base.content', 'p-4');
        TallStackUi::personalize()
            ->alert()
            ->block('wrapper', 'mb-4 rounded-lg p-4');
    }
}
