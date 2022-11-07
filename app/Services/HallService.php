<?php

namespace App\Services;

use App\Repositories\HallRepository\HallRepositoryInterface;
use Illuminate\Support\Facades\DB;

class HallService
{
    protected HallRepositoryInterface $hallRepository;

    public function __construct(HallRepositoryInterface $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        try {
            DB::beginTransaction();

            $this->hallRepository->create($data);

        } catch (\Exception $e) {
            DB::rollBack();
        }

        DB::commit();
    }

    /**
     * @return mixed
     */
    public function getAll() : mixed
    {
        return $this->hallRepository->getAll();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id) : mixed
    {
        return $this->hallRepository->getById($id);
    }
}
