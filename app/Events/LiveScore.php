<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LiveScore implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $schedule_id;
    public $team;
    public $score;
    public $set;
    public $status;
    public $resultT1;
    public $resultT2;
    public $queue = 'live-score';

    public function __construct($schedule_id, $team, $score, $set, $resultT1 = 0, $resultT2 = 0)
    {
        $this->schedule_id = $schedule_id;
        $this->team = $team;
        $this->score = $score;
        $this->set = $set;
        $this->resultT1 = $resultT1;
        $this->resultT2 = $resultT2;
    }

    public function broadcastOn()
    {
        return new Channel('live-score');
    }

    public function broadcastAs()
    {
        return 'update-score';
    }

    public function broadcastWith()
    {
        return [
            'schedule_id' => $this->schedule_id,
            'team' => $this->team,
            'score' => $this->score,
            'set' => $this->set,
            'resultT1' => $this->resultT1,
            'resultT2' => $this->resultT2,
        ];
    }
}
