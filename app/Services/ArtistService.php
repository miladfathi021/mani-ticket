<?php

namespace App\Services;

use App\Repositories\ArtistRepository\ArtistRepositoryInterface;

class ArtistService
{
    protected ArtistRepositoryInterface $artistRepository;
    protected MediaService $mediaService;

    public function __construct(ArtistRepositoryInterface $artistRepository, MediaService $mediaService)
    {
        $this->artistRepository = $artistRepository;
        $this->mediaService = $mediaService;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        if (array_key_exists('image', $data)) {
            $data['path'] = $this->mediaService->upload($data['image']);
        }
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
