<?php

namespace App\Repositories\SeatRepository;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EloquentSeatRepository implements SeatRepositoryInterface
{
    protected Seat $model;
    public function __construct(Seat $seat)
    {
        $this->model = $seat;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    public function create($data) : bool
    {
        try {
            DB::beginTransaction();

            for ($row = 1; $row <= $data->row_count; $row++) {
                for ($column = 1; $column <= $data->column_count; $column++) {
                    $data->seats()->create([
                        'column' => $column,
                        'row' => $row,
                        'seat_code' => $data->hall_id . 'H' . $data->id . 'S' . $column . 'C' . $row . 'R000' . Str::random(12)
                    ]);
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
        }

        DB::commit();
        return true;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getById(Hall $id)
    {
        // TODO: Implement getById() method.
    }
}
