<?php

namespace App\Services;

use App\Exceptions\DatabaseQueryException;
use App\Repositories\SeatRepository\SeatRepositoryInterface;
use App\Repositories\SectionRepository\SectionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SectionService
{
    protected SectionRepositoryInterface $sectionRepository;
    protected SeatRepositoryInterface $seatRepository;

    /**
     * SectionService constructor.
     *
     * @param \App\Repositories\SectionRepository\SectionRepositoryInterface $sectionRepository
     * @param \App\Repositories\SeatRepository\SeatRepositoryInterface       $seatRepository
     */
    public function __construct(SectionRepositoryInterface $sectionRepository, SeatRepositoryInterface $seatRepository)
    {
        $this->sectionRepository = $sectionRepository;
        $this->seatRepository = $seatRepository;
    }

    /**
     * @param $data
     *
     * @throws \App\Exceptions\DatabaseQueryException
     */
    public function create($data)
    {
        try {
            DB::beginTransaction();

            foreach ($data['sections'] as $section) {
                $section = $this->sectionRepository->create($section);
                $this->createSeats($section);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            throw new DatabaseQueryException();
        }

        DB::commit();
    }

    /**
     * @param $data
     */
    public function createSeats($data)
    {
        $this->seatRepository->create($data);
    }

    /**
     * @return mixed
     */
    public function getAll() : mixed
    {
        return $this->sectionRepository->getAll();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id) : mixed
    {
        return $this->sectionRepository->getById($id);
    }

    /**
     * @throws \App\Exceptions\DatabaseQueryException
     */
    public function update($data, $id)
    {
        try {
            DB::beginTransaction();

            $this->sectionRepository->update($data, $id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            throw new DatabaseQueryException();
        }

        DB::commit();

        return $this->sectionRepository->update($data, $id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id) : mixed
    {
        return $this->sectionRepository->delete($id);
    }
}
