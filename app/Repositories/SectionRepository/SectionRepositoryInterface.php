<?php

namespace App\Repositories\SectionRepository;

use App\Models\Hall;

interface SectionRepositoryInterface
{
    public function create($data);

    public function getAll();

    public function getById($id);

    public function update($data, $id);
}
