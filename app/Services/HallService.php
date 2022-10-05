<?php

namespace App\Services;

use App\Repositories\HallRepository\HallRepositoryInterface;
use Illuminate\Support\Facades\DB;

class HallService
{
    protected $hallRepository;

    public function __construct(HallRepositoryInterface $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();

            $hall = $this->hallRepository->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'address' => $data['address'],
            ]);

            if (count($data)) {
                foreach ($data['floors'] as $floor) {
                    $this->hallRepository->create([
                        'name' => $floor['name'],
                        'description' => $floor['description'],
                        'parent_id' => $hall->id,
                    ]);
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
        }

        DB::commit();
    }
}
