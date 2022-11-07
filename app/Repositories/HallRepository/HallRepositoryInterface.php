<?php

namespace App\Repositories\HallRepository;

use App\Models\Hall;

interface HallRepositoryInterface
{
    public function create($data);

    public function getAll();

    public function getById(Hall $id);
}
