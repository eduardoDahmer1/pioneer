<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\BackInStock;
use App\Events\WatchPix;
use App\Listeners\HandleBackInStock;
use App\Listeners\HandleWatchPix;
use App\Models\Category;
use App\Models\Product;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        BackInStock::class => [
            HandleBackInStock::class
        ],
        WatchPix::class => [
            HandleWatchPix::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
