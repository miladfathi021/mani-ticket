<?php

namespace App\Repositories\HallRepository;

use App\Models\Hall;

interface HallRepositoryInterface
{
    public function create($data);

    public function getAll();

    public function getById($id);

    public function update($data, $id);

    public function delete($id);

    public function get_a_hall_with_sections($id);
}
