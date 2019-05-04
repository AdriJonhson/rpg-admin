<?php

namespace App\Listeners;

use App\Events\BoardJoin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlayersTest
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
     * @param  BoardJoin  $event
     * @return void
     */
    public function handle(BoardJoin $event)
    {
        //
    }
}
