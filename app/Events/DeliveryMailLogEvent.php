<?php

namespace App\Events;

use App\Mail\DeliveryMailable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeliveryMailLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var DeliveryMailable */
    public $mailable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(DeliveryMailable $mailable)
    {
        $this->mailable = $mailable;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
