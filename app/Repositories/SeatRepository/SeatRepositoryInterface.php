<?php

namespace App\Repositories\SeatRepository;

use App\Models\Hall;

interface SeatRepositoryInterface
{
    public function create($data);

    public function getAll();

    public function getById(Hall $id);
}
