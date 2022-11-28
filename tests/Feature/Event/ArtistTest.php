<?php

namespace Tests\Feature\Event;

use App\Models\Artist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function admin_can_create_a_artist()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        Storage::fake('public');
        $file = UploadedFile::fake()->create('image.jpg');

        $data = [
            'name' => 'shakira',
            'image' => $file
        ];

        $this->assertDatabaseCount('artists', 0);
        $this->assertDatabaseCount('media', 0);

        $this->postJson(route('artists.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('media', 1);
        $this->assertDatabaseCount('artists', 1);

        $this->assertDatabaseHas('artists', [
            'name' => $data['name']
        ]);
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
