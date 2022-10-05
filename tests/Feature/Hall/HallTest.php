<?php

namespace Tests\Feature\Hall;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HallTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function unauthenticated_user_can_not_create_a_new_hall()
    {
        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
            'floors' => []
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(401);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function create_a_new_hall()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
            'floors' => [
                [
                    'name' => 'first floor',
                    'description' => 'This is a description',
                ],
                [
                    'name' => 'second floor',
                    'description' => 'This is a description',
                ]
            ]
        ];

//        'section' => [
//        [
//            'name' => 'first floor',
//            'description' => 'This is a description',
//            'row_count' => 4,
//            'column_count' => 4,
//            'row_number_from' => 10,
//            'column_number_from' => 12,
//        ]
//    ]

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('halls', 3);
        $this->assertDatabaseHas('halls', [
            'name' => 'Milad Hall'
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
            'floors' => []
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function name_must_be_string()
    {
        $this->singIn();
        $data = [
            'name' => 22,
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
            'floors' => []
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function description_must_be_string()
    {
        $this->singIn();
        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => [],
            'floors' => []
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function address_must_be_string()
    {
        $this->singIn();
        $data = [
            'name' => 'Milad Hall',
            'address' => [],
            'description' => 'This is a description',
            'floors' => []
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function floors_is_required()
    {
        $this->singIn();
        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function floors_must_be_array()
    {
        $this->singIn();
        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
            'floors' => 'Hello'
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function floor_name_is_required()
    {
        $this->singIn();

        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
            'floors' => [
                [
                    'name' => null,
                    'description' => 'This is a description',
                ],
            ]
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }

    /** @test **/
    public function floor_name_must_be_string()
    {
        $this->singIn();

        $data = [
            'name' => 'Milad Hall',
            'address' => 'Tehran Iran',
            'description' => 'This is a description',
            'floors' => [
                [
                    'name' => 55,
                    'description' => 'This is a description',
                ],
            ]
        ];

        $this->assertDatabaseCount('halls', 0);

        $this->postJson(route('halls.store'), $data)
            ->assertStatus(400);

        $this->assertDatabaseCount('halls', 0);
    }
}
