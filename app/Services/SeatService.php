<?php

namespace App\Services;

use Illuminate\Support\Str;

class SeatService
{
    public function create($section)
    {
        for ($row = 1; $row <= $section->row_count; $row++) {
            for ($column = 1; $column <= $section->column_count; $column++) {
                $section->seats()->create([
                    'column' => $column,
                    'row' => $row,
                    'seat_code' => $section->hall_id . 'H' . $section->id . 'S' . $column . 'C' . $row . 'R000' . Str::random(12)
                ]);
            }
        }
    }

    public function get_seats_by_section_id($id)
    {
//        return $this->seatRepository->get_seats_by_section_id($id);
    }
}
