<?php

namespace App\Repositories\HallRepository;

use App\Models\EventHall;
use App\Models\Hall;
use App\Repositories\ComplexRepository\ComplexRepositoryInterface;

class EloquentHallRepository implements HallRepositoryInterface
{
    protected Hall $model;
    protected ComplexRepositoryInterface $complexRepository;

    public function __construct(Hall $hall, ComplexRepositoryInterface $complexRepository)
    {
        $this->model = $hall;
        $this->complexRepository = $complexRepository;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        return auth()->user()->complexes()->find($data['complex_id'])->halls()->create($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() : \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('complex')->get();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
     */
    public function getById($id) : \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return $this->model->with('complex')->find($id);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return bool|int
     */
    public function update($data, $id) : bool|int
    {
        $hall = $this->getById($id);

        return $hall->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id) : mixed
    {
        $hall = $this->getById($id);

        return $hall->delete();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function get_a_hall_with_sections($id) : mixed
    {
        $event_hall = EventHall::find($id);

        return $event_hall->hall()->with('sections')->first();
    }
}
