<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public string $message;
    public string $employee_id;
    public string $employee_name;

    public function __construct(string $message,string $employee_id,string $employee_name)
    {
        $this->message = $message;
        $this->employee_id = $employee_id;
        $this->employee_name = $employee_name;
    }


    public function broadcastOn()
    {
        return new Channel('public');
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
