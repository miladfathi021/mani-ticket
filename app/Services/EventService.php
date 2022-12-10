<?php

namespace App\Services;

use App\Exceptions\DatabaseQueryException;
use App\Models\Event;
use App\Repositories\EventRepository\EventRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventService
{
    protected EventRepositoryInterface $eventRepository;
    private Event $event;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
       $this->eventRepository = $eventRepository;
    }

    /**
     * @param $data
     *
     * @return array
     * @throws \App\Exceptions\DatabaseQueryException
     */
    public function create($data) : array
    {
        try {
            DB::beginTransaction();

            $this->create_event($data);
            $this->create_event_hall($data['halls']);
            $this->create_event_seat($data['halls']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            throw new DatabaseQueryException();
        }

        DB::commit();
        return [];
    }

    /**
     * @param $data
     *
     * @return void
     */
    private function create_event($data)
    {
        $this->event = $this->eventRepository->create($data);
    }

    /**
     * @param $data
     *
     * @return void
     */
    private function create_event_hall($data)
    {
        $this->eventRepository->create_event_hall($this->event, $data);
    }

    /**
     * @param $data
     *
     * @return void
     */
    private function create_event_seat($data)
    {
        $this->eventRepository->create_event_seat($this->event, $data);
    }

    /**
     * @return mixed
     */
    public function get_all() : mixed
    {
        return $this->eventRepository->get_all();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function get_by_id($id) : mixed
    {
        return $this->eventRepository->get_by_id($id);
    }

    /**
     * @return mixed
     */
    public function get_all_active_events() : mixed
    {
        return $this->eventRepository->get_all_active_events();
    }
}
