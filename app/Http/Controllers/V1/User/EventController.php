<?php

namespace App\Http\Controllers\V1\User;

use App\Filters\EventFilters;
use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Services\EventService;

class EventController extends ApiController
{
    /**
     * @param \App\Services\EventService $eventService
     * @param \App\Filters\EventFilters  $filters
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EventService $eventService, EventFilters $filters) : \Illuminate\Http\JsonResponse
    {
        $events = $eventService->get_all_active_events($filters);

        return $this->response(
            new EventCollection($events)
        );
    }

    /**
     * @param \App\Services\EventService $eventService
     * @param                            $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(EventService $eventService, $id) : \Illuminate\Http\JsonResponse
    {
        $event = $eventService->get_event_with_halls($id);

        return $this->response(
            new EventResource($event)
        );
    }
}
