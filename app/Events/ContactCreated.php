<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ContactCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var array
     */
    public $contact;

    /**
     * Create a new event instance.
     *
     * @param array $contact
     */
    public function __construct(array $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('contact-channel');
    }
}
