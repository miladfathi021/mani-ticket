<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\ArtistRequest;
use App\Http\Resources\ArtistCollection;
use App\Http\Resources\ArtistResource;
use App\Services\ArtistService;

class ArtistController extends ApiController
{
    protected ArtistService $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $artists = $this->artistService->getAll();

        return $this->response(
            new ArtistCollection($artists)
        );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $artist = $this->artistService->getById($id);

        return $this->response(
            new ArtistResource($artist)
        );
    }

    /**
     * @param \App\Http\Requests\Admin\ArtistRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArtistRequest $request) : \Illuminate\Http\JsonResponse
    {
        $this->artistService->create($request->all());

        return $this->response(message: 'Artist created successfully!');
    }
}
