<?php

namespace App\Events;

use App\Http\Resources\EventSeatCollection;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class ChangeSeatStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $seats;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request, string $redisKeyName)
    {
        $seats = json_decode(Redis::get($redisKeyName), true);

        $this->seats = collect($seats)->filter(function ($value, $key) use ($request) {
            if ($value['section_id'] == $request->get('section_id')) {
                return $value;
            }
        });
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() : Channel|array
    {
        return new Channel('change-seat-status');
    }

    public function broadcastWith()
    {
        return (new EventSeatCollection($this->seats))->resolve();
    }
}
