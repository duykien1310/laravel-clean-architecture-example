<?php

namespace App\Providers;

use App\Infrastructure\Repository\Order\OrderRepository;
use App\Infrastructure\Repository\Order\OrderRepositoryInterface;
use App\Infrastructure\Repository\OrderDetail\OrderDetailRepository;
use App\Infrastructure\Repository\OrderDetail\OrderDetailRepositoryInterface;
use App\Infrastructure\Repository\Product\ProductRepository;
use App\Infrastructure\Repository\Product\ProductRepositoryInterface;
use App\Infrastructure\Repository\User\UserRepository;
use App\Infrastructure\Repository\User\UserRepositoryInterface;
use App\UseCase\Order\OrderService;
use App\UseCase\Order\OrderUseCase;
use App\UseCase\Product\ProductService;
use App\UseCase\Product\ProductUseCase;
use App\UseCase\User\UserService;
use App\UseCase\User\UserUseCase;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserUseCase::class, UserService::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductUseCase::class, ProductService::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderUseCase::class, OrderService::class);

        $this->app->bind(OrderDetailRepositoryInterface::class, OrderDetailRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
