<?php

namespace App\Events\Delivery;

use App\Mail\DeliveryMailable;
use App\Models\DeliveryMailLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeliveryMailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var DeliveryMailable
     */
    public $mailable;

    /**
     * @var DeliveryMailLog
     */
    public $log;

    /**
     * Create a new event instance.
     *
     * @param DeliveryMailable $mailable
     * @param DeliveryMailLog $log
     * @return void
     */
    public function __construct(DeliveryMailable $mailable, DeliveryMailLog $log)
    {
        $this->mailable = $mailable;
        $this->log = $log;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
//         return new PrivateChannel('channel-name');
    }
}
