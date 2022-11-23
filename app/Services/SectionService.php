<?php

namespace App\Services;

use App\Repositories\SeatRepository\SeatRepositoryInterface;
use App\Repositories\SectionRepository\SectionRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
    public function getAll()
    {
        return $this->sectionRepository->getAll();
    }
}
