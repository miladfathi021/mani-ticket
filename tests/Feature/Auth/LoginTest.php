<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function user_can_login()
    {
        $this->withoutExceptionHandling();
        Artisan::call('passport:install');

        User::factory()->create([
            'phone' => '09215420796',
            'email' => 'miladfathi021@gmail.com'
        ]);

        $data = [
            'phone' => '09215420796',
            'password' => 'password'
        ];

        $this->postJson(route('login'), $data)
            ->assertStatus(200);

        $this->assertEquals('miladfathi021@gmail.com', auth()->user()->email);
    }
}
