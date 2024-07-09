<?php

namespace App\Providers;

use App\Interfaces\Repository\IBookRepository;
use App\Interfaces\Repository\IGenreRepository;
use App\Interfaces\Service\IBookService;
use App\Interfaces\Service\IGenreService;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use App\Services\BookService;
use App\Services\GenreService;
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
        $this->app->singleton(IBookService::class,BookService::class);
        $this->app->singleton(IBookRepository::class, BookRepository::class);
        $this->app->singleton(IGenreService::class, GenreService::class);
        $this->app->singleton(IGenreRepository::class, GenreRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
