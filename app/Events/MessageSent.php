<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\User;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Hash;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $group_id;
    public $queue = 'chat-message';

    public function __construct(User $user, Message $message, $group_id)
    {
        $this->user = $user;
        $this->message = $message;
        $this->group_id = $group_id;
    }

    public function broadcastOn()
    {
        return new Channel('chat-group-' . $this->group_id);
    }

    public function broadcastAs()
    {
        return 'message-group';
    }

    public function broadcastWith()
    {
        $userHash = Hash::make($this->user->id);
        $groupHash = Hash::make($this->group_id);

        if ($this->user->profile_photo_path == null) {
            $userImage = '/images/no-image.png';
        } else {
            $userImage = $this->user->profile_photo_path;
        }

        return [
            'user_id' => $userHash,
            'message' => $this->message->message,
            'group_id' => $groupHash,
            'user_image' => $userImage
        ];
    }
}
