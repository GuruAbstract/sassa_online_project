<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\EventVisited;
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
        'App\Events\EventVisited'=>
            ['App\Listeners\EventVisitedListener',

            ]
            ,
        'App\Events\EventHome'=>
            ['App\Listeners\EventHomeListener',

            ]
        ,'App\Events\EventTest'=>['App\Listeners\EventTestListener'],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
