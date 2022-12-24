<?php

namespace App\Http\Controllers\V1\User;


use App\Http\Controllers\V1\ApiController;
use Illuminate\Support\Facades\Redis;

class SeatController extends ApiController
{
    public function __construct()
    {
    }

    public function show($event_hall_id, $section_id)
    {
        dd(Redis::get('events_' . $event_hall_id));
    }
}
