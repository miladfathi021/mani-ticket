<?php

namespace App\Repositories\EventRepository;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function create($data);

    public function create_event_hall(Event $event, array $data);

    public function create_event_seat(Event $event, array $data);

    public function get_all();

    public function get_by_id($id);

    public function get_todays_events();

    public function get_event_seats($hallId);

    public function get_all_active_events();
}
