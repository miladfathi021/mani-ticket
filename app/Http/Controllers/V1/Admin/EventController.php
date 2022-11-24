<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Services\EventService;

class EventController extends ApiController
{
    protected EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $events = $this->eventService->getAll();

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
        $event = $this->eventService->getById($id);

        return $this->response(
            new EventResource($event)
        );
    }

    /**
     * @param \App\Http\Requests\EventRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DatabaseQueryException
     */
    public function store(EventRequest $request) : \Illuminate\Http\JsonResponse
    {
        $this->eventService->create($request->all());

        return $this->response(message: 'Event created successfully!');
    }
}
