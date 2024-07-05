<?php

namespace App\Providers;

use app\Interfaces\Repository\IBookRepository;
use app\Interfaces\Repository\IGenreRepository;
use app\Interfaces\Service\IBookService;
use app\Interfaces\Service\IGenreService;
use app\Repository\BookRepository;
use app\Repository\GenreRepository;
use app\Services\BookService;
use app\Services\GenreService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(IBookService::class, BookService::class);
        $this->app->singleton(IBookRepository::class, BookRepository::class);
        $this->app->singleton(IGenreService::class, GenreService::class);
        $this->app->singleton(IGenreRepository::class, GenreRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
