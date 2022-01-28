<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function boot()
    {


        // Executed when a test database is created...
        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            $this->artisan('migrate:refresh --seed');
        });

    }


    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
//        $this->seed();
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123password',
            'password_confirmation' => '123password',
        ]);
//        dump($response);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

    }


}
