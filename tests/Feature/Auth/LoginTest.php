<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function user_can_login()
    {
        $this->withoutExceptionHandling();

        User::factory()->create([
            'phone' => '09215420796',
            'email' => 'miladfathi021@gmail.com'
        ]);

        $data = [
            'phone' => '09215420796',
            'password' => 'password'
        ];

        $this->postJson(route('login'), $data)
            ->dd();
//            ->assertStatus(200);
        $this->assertEquals($data['email'], auth()->user()->email);
    }
}
