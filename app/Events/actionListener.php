<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class actionListener
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $userId;
    private $action;
    private $path;
    private $details;
    public function __construct($userId, $action, $path, $details)
    {
        $this->userId = $userId;
        $this->action = $action;
        $this->path = $path;
        $this->details = $details;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
