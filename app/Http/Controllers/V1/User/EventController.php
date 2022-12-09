<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\EventCollection;
use App\Services\EventService;

class EventController extends ApiController
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->get_all_active_events();

        return $this->response(
            new EventCollection($events)
        );
    }
}