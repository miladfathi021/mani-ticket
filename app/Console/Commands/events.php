<?php

namespace App\Console\Commands;

use App\Repositories\EventRepository\EventRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class events extends Command
{
    protected EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        parent::__construct();
        $this->eventRepository = $eventRepository;
    }

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
    public function handle()
    {
        $events = $this->eventRepository->get_todays_events();

        if ($events->count()) {
            $events->each(function ($item) {
                $event = $this->eventRepository->get_by_id($item->event_id);
                $seats = $event->seats()->where('event_hall_id', $item->id)->get();

                Redis::set('events_' . $item->id, $seats);
            });
        }
        
        return Command::SUCCESS;
    }
}
