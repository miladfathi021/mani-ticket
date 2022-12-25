<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Services\EventService;

class EventController extends ApiController
{
    /**
     * @param \App\Services\EventService $eventService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EventService $eventService) : \Illuminate\Http\JsonResponse
    {
        $events = $eventService->get_all_active_events();

        return $this->response(
            new EventCollection($events)
        );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $event = $this->eventService->get_event_with_halls($id);

        return $this->response(
            new EventResource($event)
        );
    }
}
