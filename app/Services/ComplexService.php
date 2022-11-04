<?php

namespace App\Services;

use App\Repositories\ComplexRepository\ComplexRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ComplexService
{
    protected ComplexRepositoryInterface $complexRepository;

    public function __construct(ComplexRepositoryInterface $complexRepository)
    {
        $this->complexRepository = $complexRepository;
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        try {
            DB::beginTransaction();

            $this->complexRepository->create($data);

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
        return $this->complexRepository->getAll();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id) : mixed
    {
        return $this->complexRepository->getById($id);
    }
}
