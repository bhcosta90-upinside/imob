<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        Blade::component('admin.components.message', 'message');
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Database\Query\Builder::macro('toRawSql', function () {
            return array_reduce($this->getBindings(), function ($sql, $binding) {
                return preg_replace('/\?/', is_numeric($binding) ? $binding : "'" . $binding . "'", $sql, 1);
            }, $this->toSql());
        });

        \Illuminate\Database\Eloquent\Builder::macro('toRawSql', function () {
            return ($this->getQuery()->toRawSql());
        });
    }
}
