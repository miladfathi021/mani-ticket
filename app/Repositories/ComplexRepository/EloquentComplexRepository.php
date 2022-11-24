<?php

namespace App\Repositories\ComplexRepository;

use App\Models\Complex;
use App\Models\Hall;

class EloquentComplexRepository implements ComplexRepositoryInterface
{
    protected Complex $model;

    public function __construct(Complex $complex)
    {
        $this->model = $complex;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        return auth()->user()->complexes()->create($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() : \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id) : mixed
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return mixed
     */
    public function update($data, $id) : mixed
    {
        $complex = $this->getById($id);

        return $complex->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id) : mixed
    {
        $complex = $this->getById($id);

        return $complex->delete();
    }
}
