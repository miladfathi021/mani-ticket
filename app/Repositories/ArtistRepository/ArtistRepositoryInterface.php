<?php

namespace App\Repositories\ArtistRepository;

interface ArtistRepositoryInterface
{
    public function create($data);

    public function getAll();

    public function getById($id);

    public function update($data, $id);

    public function delete($id);
}
