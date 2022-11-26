<?php

namespace App\Console\Commands;

use App\Repositories\EventRepository\EventRepositoryInterface;
use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $events = $this->eventRepository->getEventsFromToday();
        dd($events->toArray());
        return Command::SUCCESS;
    }
}
