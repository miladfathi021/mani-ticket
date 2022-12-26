<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Milad Fathi',
            'phone' => '09215420796',
            'email' => 'miladfathi021@gmail.com'
        ]);
        $this->call([
            CitySeeder::class
        ]);
    }
}
