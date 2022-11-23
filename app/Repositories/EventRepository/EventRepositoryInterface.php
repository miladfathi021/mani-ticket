<?php

namespace App\Repositories\EventRepository;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function create($data);

    public function create_event_hall(Event $event, array $data);

    public function create_event_seat(Event $event, array $data);

    public function getAll();

    public function getById($id);
}
