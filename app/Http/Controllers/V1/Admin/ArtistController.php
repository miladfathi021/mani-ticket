<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\ArtistRequest;
use App\Http\Resources\ArtistCollection;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use App\Services\MediaService;
use Illuminate\Support\Facades\DB;

class ArtistController extends ApiController
{
    /**
     * Get a list of artists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {

        $artists = Artist::query()->latest()->get();

        return $this->response(
            new ArtistCollection($artists)
        );
    }

    /**
     * Get an artist by id
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $artist = Artist::query()->findOrFail($id);

        return $this->response(
            new ArtistResource($artist)
        );
    }

    /**
     * Create a new artist
     *
     * @param \App\Http\Requests\Admin\ArtistRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArtistRequest $request) : \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $artist = Artist::query()->create($request->all());
            MediaService::store($artist, $request);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError();
        }

        DB::commit();

        return $this->response(message: 'Artist created successfully!');
    }
}
