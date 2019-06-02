<?php

namespace App\Listeners;

use App\Events\StatusEvents;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusUpdatedListeners
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StatusEvents  $event
     * @return void
     */
    public function handle(StatusEvents $event)
    {
        //
    }
}
