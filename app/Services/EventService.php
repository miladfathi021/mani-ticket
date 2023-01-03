<?php

namespace App\Services;

use App\Filters\EventFilters;
use App\Models\Complex;
use App\Models\Event;
use App\Models\Seat;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventService
{
    /**
     * @param $request
     *
     * @return mixed
     */
    public function createEvent($request) : mixed
    {
        return Complex::query()
            ->find($request->get('complex_id'))
            ->events()
            ->create([
                "name" => $request->get('name'),
                "artist_id" => $request->get('artist_id'),
                "description" => $request->get('description'),
                "date_start" => $request->get('date_start'),
                "time_start" => $request->get('time_start'),
                "date_end" => $request->get('date_end'),
                "time_end" => $request->get('time_end')
            ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $event
     *
     * @return void
     */
    public function createEventHall(Request $request, $event)
    {
        foreach ($request->get('halls') as $hall) {
            $event->halls()->attach($event->id, $hall);
        }

    }

    /**
     * @param $request
     * @param $event
     *
     * @return void
     */
    public function createEventSeat($request, $event)
    {
        foreach ($request->get('halls') as $hall) {
            $sections = Section::where('hall_id', $hall['hall_id'])->with('seats')->get();
            if (!$sections->count()) continue;

            $event_hall_id = $event->halls()->where([
                ['hall_id', '=', $hall['hall_id']],
                ['date_start', '=', $hall['date_start']],
                ['time_start', '=', $hall['time_start']],
                ['date_end', '=', $hall['date_end']],
                ['time_end', '=', $hall['time_end']]
            ])->first()->pivot->id;

            $sections->each(function ($section) use ($event, $event_hall_id) {
                $seatIds = $section->seats->pluck('id');

                $seatIds->each(function ($seatId) use ($event, $event_hall_id) {
                    $event->seats()->attach($seatId, [
                        'seat_status' => Seat::$STATUS['active'],
                        'event_hall_id' => $event_hall_id
                    ]);
                });
            });
        }
    }

    /**
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getTodaysEvents() : array|\Illuminate\Database\Eloquent\Collection
    {
        return Event::query()->where('date_start', Carbon::today()->toDateString())->get();
    }

    /**
     * @param \App\Filters\EventFilters $filters
     *
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllActiveEvents(EventFilters $filters) : array|\Illuminate\Database\Eloquent\Collection
    {
        return Event::query()
            ->filter($filters)
            ->whereDate('date_start', '<=', Carbon::today()->format('Y-m-d'))
            ->whereDate('date_end', '>=', Carbon::today()->format('Y-m-d'))
            ->with(['artist', 'complex'])
            ->get();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEventWithHalls($id) : \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return Event::query()->with(['halls', 'complex', 'artist'])->find($id);
    }
}
