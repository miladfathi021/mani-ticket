<?php

namespace Tests\Feature\Complex;

use App\Models\Complex;
use App\Models\Hall;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComplexTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function unauthenticated_user_can_not_create_a_new_complex()
    {
        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('complexes', 0);

        $this->postJson(route('complexes.store'), $data)
            ->assertStatus(401);

        $this->assertDatabaseCount('complexes', 0);
    }

    /** @test **/
    public function admin_can_create_a_new_complex()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $data = [
            'name' => 'Milad Complex',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('complexes', 0);

        $this->postJson(route('complexes.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('complexes', 3);
        $this->assertDatabaseHas('complexes', [
            'name' => 'Milad Complex'
        ]);
    }

    /** @test **/
    public function name_is_required()
    {
        $this->singIn();
        $data = [
            'name' => null,
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('complexes', 0);

        $this->postJson(route('complexes.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('complexes', 0);
    }

    /** @test **/
    public function name_must_be_string()
    {
        $this->singIn();
        $data = [
            'name' => 22,
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('complexes', 0);

        $this->postJson(route('complexes.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('complexes', 0);
    }

    /** @test **/
    public function description_must_be_string()
    {
        $this->singIn();
        $data = [
            'name' => 'Milad Complex',
            'address' => 'Tehran Iran',
            'description' => [],
        ];

        $this->assertDatabaseCount('complexes', 0);

        $this->postJson(route('complexes.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('complexes', 0);
    }

    /** @test **/
    public function address_must_be_string()
    {
        $this->singIn();
        $data = [
            'name' => 'Milad Complex',
            'address' => [],
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('complexes', 0);

        $this->postJson(route('complexes.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('complexes', 0);
    }

    /** @test **/
    public function admin_can_see_all_complexes()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $complexes = Complex::factory()->count(3)->create();

        $this->getJson(route('complexes.index'))
            ->assertJson([
                "data" => [
                    [
                        "name" => $complexes[0]['name']
                    ],
                    [
                        "name" => $complexes[1]['name']
                    ]
                ]
            ])
            ->assertStatus(200);

        $this->assertDatabaseCount('complexes', 3);
    }

    /** @test **/
    public function admin_can_see_a_complex()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $complex = Complex::factory()->create();

        $this->getJson(route('complexes.show', $complex->id))
            ->assertJson([
                "data" => [
                    "name" => $complex['name']
                ]
            ])
            ->assertStatus(200);

        $this->assertDatabaseCount('complexes', 1);
    }
}
