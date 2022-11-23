<?php

namespace App\Repositories\SectionRepository;

use App\Models\Hall;
use App\Models\Section;
use App\Repositories\HallRepository\HallRepositoryInterface;

class EloquentSectionRepository implements SectionRepositoryInterface
{
    protected Section $model;
    protected HallRepositoryInterface $hallRepository;

    /**
     * EloquentSectionRepository constructor.
     *
     * @param \App\Models\Section                                         $section
     * @param \App\Repositories\HallRepository\HallRepositoryInterface $hallRepository
     */
    public function __construct(Section $section, HallRepositoryInterface $hallRepository)
    {
        $this->model = $section;
        $this->hallRepository = $hallRepository;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data) : mixed
    {
        return $this->hallRepository
            ->getById($data['hall_id'])
            ->sections()->create([
               'name' => $data['name'],
               'description' => $data['description'],
               'row_count' => $data['row_count'],
               'column_count' => $data['column_count'],
               'row_number_from' => $data['row_number_from'],
               'column_number_from' => $data['column_number_from']
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll() : \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->model->with(['hall', 'seats'])->get();
    }

    public function getById(Hall $id)
    {
        // TODO: Implement getById() method.
    }
}