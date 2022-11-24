<?php

namespace App\Services;

use App\Repositories\ArtistRepository\ArtistRepositoryInterface;

class ArtistService
{
    protected ArtistRepositoryInterface $artistRepository;

    public function __construct(ArtistRepositoryInterface $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        return $this->artistRepository->create($data);
    }

    /**
     * @return mixed
     */
    public function getAll() : mixed
    {
        return $this->artistRepository->getAll();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id) : mixed
    {
       return $this->artistRepository->getById($id);
    }
}
