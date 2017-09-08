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

class DeliveryMailLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var DeliveryMailable */
    public $mailable;

    /** @var DeliveryMailLog */
    public $log;

    /** @var string */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param DeliveryMailable $mailable
     * @param string $message
     * @return void
     */
    public function __construct(DeliveryMailable $mailable, DeliveryMailLog $log, string $message)
    {
        $this->mailable = $mailable;
        $this->log      = $log;
        $this->message  = $message;
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
