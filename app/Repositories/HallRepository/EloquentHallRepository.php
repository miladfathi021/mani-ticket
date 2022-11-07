<?php

namespace App\Repositories\HallRepository;

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
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }
}
