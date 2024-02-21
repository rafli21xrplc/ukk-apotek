<?php

namespace App\Listeners;

use App\Events\actionListener as EventsActionListener;
use App\Models\log;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class actionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsActionListener $event): void
    {
        log::create([
            'id_log' => Str::uuid(),
            'method' => $event->getAction(),
            'message' => $event->getDetails(),
            'url' => $event->getPath(),
            'id_user' => $event->getUserId()
        ]);
    }
}

