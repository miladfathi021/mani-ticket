<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Repositories\EventRepository\EventRepositoryInterface;
use App\Services\EventService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class events extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Find today's events and add them to redis";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(EventService $eventService)
    {
        $events = $eventService->get_todays_events();

        if ($events->count()) {

            $events->each(function ($event) {
                $event->halls->each(function ($item) {
                    $event = Event::query()->find($item->event_id);
                    $seats = $event->seats()->where('event_hall_id', $item->id)->get();

                    Redis::set('events_' . $item->id, $seats);
                });
            });
        }

        return Command::SUCCESS;
    }
}
