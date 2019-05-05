<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CardUpdated implements ShouldBroadcast
{
//    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $rpg;
    public $card;

    public function __construct($rpg, $card)
    {
        $this->rpg = $rpg;
        $this->card = $card;
    }

    public function broadcastWith()
    {
        return ['name' => $this->card->name];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
        public function broadcastOn()
    {
        return new PresenceChannel('Board.Rpg.'.$this->rpg->id);
    }
}
