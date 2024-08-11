<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

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

        Builder::macro('pagination', function ($limit = null, $page = null, $additional = []) {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage();
            $limit = $limit ?: 2;
            $total = $this->count();
            $results = $total ? $this->forPage($page, $limit)->get() : new Collection();

            return new LengthAwarePaginator(
                $results,
                $total,
                $limit,
                $page,
                array_merge([
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ], $additional)
            );
        });

        Builder::macro('simplePagination', function ($limit = null, $page = null, $additional = []) {
            $page = $page ?: Paginator::resolveCurrentPage();
            $limit = $limit ?: 3;
            $results = $this->forPage($page, $limit)->get();

            return new Paginator(
                $results,
                $limit,
                $page,
                array_merge([
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ], $additional)
            );
        });
    }
}
