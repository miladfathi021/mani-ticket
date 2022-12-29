<?php

namespace App\Http\Controllers\V1\User;


use App\Events\ChangeSeatStatusEvent;
use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\EventSeatCollection;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SeatController extends ApiController
{
    protected $event_hall_id;

    /**
     * @param $event_hall_id
     * @param $section_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($event_hall_id, $section_id) : \Illuminate\Http\JsonResponse
    {
        $seats = json_decode(Redis::get('events_' . $event_hall_id), true);
        $filtered = collect($seats)->filter(function ($value, $key) use ($section_id) {
            if ($value['section_id'] == $section_id) {
                return $value;
            }
        });

        return $this->response(
            new EventSeatCollection($filtered)
        );
    }

    /**
     * @param                          $event_hall_id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($event_hall_id, Request $request) : \Illuminate\Http\JsonResponse
    {
        $seats = json_decode(Redis::get('events_' . $event_hall_id), true);
        $seats = collect($seats)->map(function($seat) use ($request) {
            if ($seat['seat_code'] === $request->get('seat_code')) {
                $seat['pivot']['seat_status'] = Seat::$STATUS['pending'];
            }
            return $seat;
        });

        Redis::del('events_' . $event_hall_id);
        Redis::set('events_' . $event_hall_id, $seats);
        event(new ChangeSeatStatusEvent($request, "events_$event_hall_id"));
        return $this->response();
    }
}
