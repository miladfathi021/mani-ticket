<?php

namespace App\Repositories\ComplexRepository;

use App\Models\Complex;

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

    public function getById($id)
    {
        return $this->model->find($id);
    }
}
