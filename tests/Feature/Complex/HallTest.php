<?php

namespace Tests\Feature\Complex;

use App\Models\Complex;
use App\Models\Hall;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HallTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function unauthenticated_user_can_not_create_a_new_hall()
    {
        $complex = Complex::factory()->create();
        $data = [
            'name' => 'Milad Hall',
            'description' => 'This is a description',
            'complex_id' => $complex->id
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('admin.halls.store'), $data)
            ->assertStatus(401);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function admin_can_create_a_new_hall()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $complex = Complex::factory()->create([
            'user_id' => auth()->id()
        ]);

        $data = [
            'name' => 'Milad Hall',
            'description' => 'This is a description',
            'complex_id' => $complex->id
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('admin.halls.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('halls', 1);
        $this->assertDatabaseHas('halls', [
            'name' => 'Milad Hall',
            'complex_id' => $complex->id
        ]);
    }

    /** @test **/
    public function name_is_required()
    {
        $this->singIn();

        $complex = Complex::factory()->create([
            'user_id' => auth()->id()
        ]);

        $data = [
            'name' => null,
            'description' => 'This is a description',
            'complex_id' => $complex->id
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('admin.halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function name_must_be_string()
    {
        $this->singIn();

        $complex = Complex::factory()->create([
            'user_id' => auth()->id()
        ]);

        $data = [
            'name' => 22,
            'description' => 'This is a description',
            'complex_id' => $complex->id
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('admin.halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function description_must_be_string()
    {
        $this->singIn();

        $complex = Complex::factory()->create([
            'user_id' => auth()->id()
        ]);

        $data = [
            'name' => 'Milad Hall',
            'description' => [],
            'complex_id' => $complex->id
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('admin.halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function admin_can_see_all_halls()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $halls = Hall::factory()->count(3)->create();

        $this->getJson(route('admin.halls.index'))
            ->assertJson([
                "data" => [
                    [
                        "name" => $halls[0]['name']
                    ],
                    [
                        "name" => $halls[1]['name']
                    ]
                ]
            ])
            ->assertStatus(200);
    }

    /** @test **/
    public function admin_can_see_a_hall()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $hall = Hall::factory()->create();

        $this->getJson(route('admin.halls.show', $hall->id))
            ->assertJson([
                "data" => [
                    "name" => $hall['name']
                ]
            ])
            ->assertStatus(200);
    }

    /** @test **/
    public function admin_can_update_a_hall()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $hall = Hall::factory()->create();
        $complex = Complex::factory()->create();

        $data = [
            'name' => 'milad',
            'description' => 'new description',
            'complex_id' => $complex->id
        ];

        $this->patchJson(route('admin.halls.update', $hall->id), $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('halls', $data);
        $this->assertDatabaseMissing('halls', $hall->toArray());
    }

    /** @test **/
    public function admin_can_delete_a_hall()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $hall = Hall::factory()->create();

        $this->assertDatabaseCount('halls', 1);

        $this->deleteJson(route('admin.halls.destroy', $hall->id))
            ->assertStatus(200);

        $this->assertDatabaseCount('halls', 1);
        $this->assertSoftDeleted('halls', $hall->toArray());
    }
}
