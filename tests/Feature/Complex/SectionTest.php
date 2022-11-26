<?php

namespace Tests\Feature\Complex;

use App\Models\Hall;
use App\Models\Seat;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function admin_can_create_a_new_section_with_its_seats()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $hall = Hall::factory()->create();

        $data = [
            'sections' => [
                [
                    'name' => 'section Vip',
                    'description' => 'This is a description',
                    'hall_id' => $hall->id,
                    'row_count' => 2,
                    'column_count' => 15,
                    'row_number_from' => 10,
                    'column_number_from' => 12,
                ]
            ]
        ];

        $this->assertDatabaseCount('sections', 0);
        $this->assertDatabaseCount('seats', 0);

        $this->postJson(route('sections.store'), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('sections', 1);
        $this->assertDatabaseCount('seats', 30);
    }

    /** @test **/
    public function admin_can_see_all_sections()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $sections = Section::factory()->count(3)->create();

        $this->getJson(route('sections.index'))
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    [
                        "name" => $sections[0]['name']
                    ]
                ]
            ]);
    }

    /** @test **/
    public function admin_can_see_a_section()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $section = Section::factory()->create();

        $this->getJson(route('sections.show', $section->id))
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    "name" => $section->name
                ]
            ]);
    }

    /** @test **/
    public function admin_can_update_a_section()
    {
        $this->withoutExceptionHandling();
        $this->singIn();

        $section = Section::factory()->create();

        $data = [
            'name' => 'section Vip',
            'description' => 'This is a description',
        ];

        $this->assertDatabaseCount('sections', 1);

        $this->patchJson(route('sections.update', $section->id), $data)
            ->assertStatus(200);

        $this->assertDatabaseCount('sections', 1);
        $this->assertDatabaseHas('sections', $data);
        $this->assertDatabaseMissing('sections', $section->toArray());
    }
}
