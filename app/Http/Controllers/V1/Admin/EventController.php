<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use App\Services\MediaService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends ApiController
{
    /**
     * Get a list of events
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $events = Event::query()->with(['complex', 'halls', 'artist'])->latest()->get();

        return $this->response(
            new EventCollection($events)
        );
    }

    /**
     * Get an event by id
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $event = Event::query()->with(['complex', 'halls', 'artist'])->findOrFail($id);

        return $this->response(
            new EventResource($event)
        );
    }

    /**
     * Create a new event
     *
     * @param \App\Http\Requests\Admin\EventRequest $request
     * @param \App\Services\EventService            $eventService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request, EventService $eventService) : \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $event = $eventService->create_event($request);
            MediaService::store($event, $request);
            $eventService->create_event_hall($request, $event);
            $eventService->create_event_seat($request, $event);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->responseError();
        }

        DB::commit();

        return $this->response(message: 'Event created successfully!');
    }
}
