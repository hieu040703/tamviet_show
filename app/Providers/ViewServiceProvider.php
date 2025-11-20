<?php

namespace App\Providers;

use App\Http\View\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\SystemComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('*', SystemComposer::class);
        View::composer(
            [
                'frontend.layouts.partials.menu',
                'frontend.layouts.partials.footer-menu-follow'],
            MenuComposer::class
        );
    }
}
