<?php

namespace App\Providers;
use App\Repository\UserRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\AuthorRepositoryInterface;
use App\Repository\BookRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\OrderBookRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\AdminRepositoryInterface;
use App\Repository\AdminRepository;
use App\Repository\OrderRepository;
use App\Repository\Repository;
use App\Repository\OrderBookRepository;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use App\Repository\UserRepository;
use App\Repository\CatgoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class,Repository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CatgoryRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class,AuthorRepository::class);
        $this->app->bind(BookRepositoryInterface::class,BookRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(OrderBookRepositoryInterface::class,OrderBookRepository::class);
        $this->app->bind(AdminRepositoryInterface::class,AdminRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
