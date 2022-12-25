<?php

namespace App\Services;

use App\Models\Hall;

class SectionService
{
    /**
     * @param $section
     *
     * @return mixed
     */
    public function create($section) : mixed
    {
        return Hall::query()
            ->where('id', $section['hall_id'])
            ->first()
            ->sections()
            ->create([
                'name' => $section['name'],
                'description' => $section['description'],
                'row_count' => $section['row_count'],
                'column_count' => $section['column_count'],
                'row_number_from' => $section['row_number_from'],
                'column_number_from' => $section['column_number_from']
            ]);
    }
}
