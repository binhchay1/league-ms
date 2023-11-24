<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\User;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $group_id;
    public $connection = 'redis';

    public function __construct(User $user, Message $message, $group_id)
    {
        $this->user = $user;
        $this->message = $message;
        $this->group_id = $group_id;
    }

    public function broadcastOn()
    {
        return [new Channel('chat-group-' . $this->group_id)];
    }

    public function broadcastAs()
    {
        return 'message-group';
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'message' => $this->message,
            'group_id' => $this->group_id,
        ];
    }
}
