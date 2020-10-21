<?php

namespace App\Listeners;

use App\Notifications\ProductNotifier;
use App\Services\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class SendProductNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        FacadesNotification::send($event->user, new ProductNotifier($event->product, $event->user));
    }
}
