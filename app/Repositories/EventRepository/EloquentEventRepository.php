<?php

namespace App\Repositories\EventRepository;

use App\Models\Event;
use App\Models\EventHall;
use App\Models\Seat;
use App\Models\Section;
use App\Repositories\ComplexRepository\ComplexRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class EloquentEventRepository implements EventRepositoryInterface
{
    protected Event $model;
    protected ComplexRepositoryInterface $complexRepository;

    /**
     * EloquentSectionRepository constructor.
     *
     * @param \App\Models\Event $event
     * @param \App\Repositories\ComplexRepository\ComplexRepositoryInterface $complexRepository
     */
    public function __construct(Event $event, ComplexRepositoryInterface $complexRepository)
    {
        $this->model = $event;
        $this->complexRepository = $complexRepository;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        return $this->complexRepository
            ->getById($data['complex_id'])
            ->events()
            ->create([
                "name" => $data['name'],
                "artist_id" => $data['artist_id'],
                "description" => $data['description'],
                "date_start" => $data['date_start'],
                "time_start" => $data['time_start'],
                "date_end" => $data['date_end'],
                "time_end" => $data['time_end']
            ]);
    }

    /**
     * @param \App\Models\Event $event
     * @param array             $data
     *
     * @return void
     */
    public function create_event_hall(Event $event, array $data)
    {
        foreach ($data as $hall) {
            $event->halls()->attach($event->id, $hall);
        }
    }

    /**
     * @param \App\Models\Event $event
     * @param array             $data
     *
     * @return void
     */
    public function create_event_seat(Event $event, array $data)
    {
        foreach ($data as $hall) {
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
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function get_all() : Collection|array
    {
        return $this->model->with(['complex', 'halls', 'artist'])->get();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder|array|null
     */
    public function get_by_id($id) : Model|Collection|Builder|array|null
    {
        return $this->model->load(['complex', 'halls', 'artist'])->find($id);
    }

    /**
     * @return mixed
     */
    public function get_todays_events() : mixed
    {
        return EventHall::where('date_start', Carbon::today()->toDateString())->get();
    }

    /**
     * @param $hallId
     *
     * @return mixed
     */
    public function get_event_seats($hallId) : mixed
    {
        return $this->get_by_id($hallId)->with('seats')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function get_all_active_events() : Collection|array
    {
        return $this->model
            ->query()
            ->whereDate('date_start', '<=', Carbon::today()->format('Y-m-d'))
            ->whereDate('date_end', '>=', Carbon::today()->format('Y-m-d'))
            ->with('artist')
            ->get();
    }
}
