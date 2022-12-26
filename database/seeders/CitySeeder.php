<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')
            ->insert([
                [
                    'name' => 'Amsterdam'
                ],
                [
                    'name' => 'The Hague'
                ],
                [
                    'name' => 'Rotterdam'
                ],
                [
                    'name' => 'Utrecht'
                ],
                [
                    'name' => 'Eindhoven'
                ],
                [
                    'name' => 'Groningen'
                ],
                [
                    'name' => 'Nijmegen'
                ],
                [
                    'name' => 'Breda'
                ],
                [
                    'name' => 'Haarlem'
                ],
            ]);
    }
}
