<?php

namespace App\Repositories\ArtistRepository;

use App\Models\Artist;

class EloquentArtistRepository implements ArtistRepositoryInterface
{
    protected Artist $model;

    public function __construct(Artist $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        $artist =  $this->model->create([
            'name' => $data['name']
        ]);

        $this->addImage($artist, $data);
        return $artist;
    }

    public function addImage($artist, $data)
    {
        $artist->image()->create([
            'path' => $data['path']
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() : \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with('image')->get();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id) : mixed
    {
        return $this->model->with('image')->find($id);
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
