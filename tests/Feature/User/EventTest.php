<?php

namespace Tests\Feature\User;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function users_can_see_all_active_events()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $event = Event::factory()->create([
            'date_start' => Carbon::today()->toDateString(),
            'date_end' => Carbon::tomorrow()->toDateString()
        ]);

        $this->getJson(route('events.index'))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'name' => $event->name,
                        'description' => $event->description,
                        'date_start' => Carbon::today()->toDateString(),
                    ]
                ]
            ]);
    }
}
