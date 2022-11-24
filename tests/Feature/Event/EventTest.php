<?php

namespace Tests\Feature\Event;

use App\Models\Artist;
use App\Models\Complex;
use App\Models\Event;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function admin_can_create_a_new_event()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $complex = Complex::factory()->create();
        $halls = Hall::factory()->count(2)->create([
            'complex_id' => $complex->id
        ]);

        $first_section = Section::factory()->create([
            'hall_id' => $halls->find(1)->id
        ]);
        $second_section = Section::factory()->create([
            'hall_id' => $halls->find(2)->id
        ]);
        $third_section = Section::factory()->create([
            'hall_id' => $halls->find(2)->id
        ]);

        Seat::factory()->count(10)->create([
            'section_id' => $first_section->id
        ]);
        Seat::factory()->count(10)->create([
            'section_id' => $second_section->id
        ]);
        Seat::factory()->count(10)->create([
            'section_id' => $third_section->id
        ]);

        $artist = Artist::factory()->create([
            'name' => 'shakira'
        ]);

        $data = [
            'name' => "Shakira's new concert",
            'description' => 'This is a description',
            'complex_id' => $complex->id,
            'artist_id' => $artist->id,
            'date_start' => '2022-01-01',
            'time_start' => '10:00',
            'date_end' => '2022-01-10',
            'time_end' => '23:55',
            'halls' => [
                [
                    'hall_id' => Hall::find(1)->id,
                    'date_start' => '2022-01-08',
                    'time_start' => '11:00',
                    'date_end' => '2022-01-08',
                    'time_end' => '13:30',
                ],
                [
                    'hall_id' => Hall::find(1)->id,
                    'date_start' => '2022-01-08',
                    'time_start' => '21:30',
                    'date_end' => '2022-01-08',
                    'time_end' => '23:59',
                ],
                [
                    'hall_id' => Hall::find(2)->id,
                    'date_start' => '2022-01-10',
                    'time_start' => '20:00',
                    'date_end' => '2022-01-10',
                    'time_end' => '22:30',
                ]
            ]
        ];

        $this->assertDatabaseCount('events', 0);
        $this->assertDatabaseCount('event_hall', 0);
        $this->assertDatabaseCount('event_seat', 0);

        $this->postJson(route('events.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('events', 1);
        $this->assertDatabaseCount('event_hall', 3);
        $this->assertDatabaseCount('event_seat', 40);

    }

//    /** @test **/
//    public function user_can_see_all_events()
//    {
//        $this->withoutExceptionHandling();
//        $this->singIn();
//
//
//        Event::factory()->count(4)->create();
//
//        $this->getJson(route())
//    }
}
