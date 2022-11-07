<?php

namespace App\Repositories\ComplexRepository;

use App\Models\Hall;

interface ComplexRepositoryInterface
{
    public function create($data);

    public function getAll();

    public function getById(Hall $id);
}
