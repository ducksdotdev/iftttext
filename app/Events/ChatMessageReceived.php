<?php

namespace App\Events;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageReceived implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    /**
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->data = $message->getData()->map(function ($message, $key) {
            if ($message->{$key} instanceof Carbon) {
                $occurredAt = $message->{key};
                return $occurredAt->timestamp;
            }
        })->toArray();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat-channel');
    }
}
