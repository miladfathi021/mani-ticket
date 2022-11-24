<?php

namespace Tests\Feature\Event;

use App\Models\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function admin_can_create_a_artist()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $data = [
            'name' => 'shakira'
        ];

        $this->assertDatabaseCount('artists', 0);

        $this->postJson(route('artists.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('artists', 1);
        $this->assertDatabaseHas('artists', $data);
    }

    /** @test **/
    public function admin_can_see_all_artists()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $artists = Artist::factory()->count(3)->create();

        $this->getJson(route('artists.index'))
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        'name' => $artists[0]->name
                    ]
                ]
            ]);
    }

    /** @test **/
    public function admin_can_see_a_artist()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $artist = Artist::factory()->create();

        $this->getJson(route('artists.show', $artist->id))
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    'name' => $artist->name
                ]
            ]);
    }
}
