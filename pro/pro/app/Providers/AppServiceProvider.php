<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ItemRepositoryInterface;
use App\Repositories\ItemRepository;
use App\Repositories\DiscountRepositoryInterface;
use App\Repositories\DiscountRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
    }

    public function boot()
    {
        //
    }
}
