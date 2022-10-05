<?php

namespace App\Repositories\HallRepository;

use App\Models\Hall;

class EloquentHallRepository implements HallRepositoryInterface
{
    protected $model;

    public function __construct(Hall $hall)
    {
        $this->model = $hall;
    }

    public function create($data)
    {
        return auth()->user()->halls()->create($data);
    }
}
