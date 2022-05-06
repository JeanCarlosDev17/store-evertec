<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public const LOGIN = '/login';

    public function boot()
    {

        // Executed when a test database is created...
        ParallelTesting::setUpTestDatabase(function () {
            $this->artisan('db:seed');
        });
    }

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get(self::LOGIN);

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $response = $this->post(self::LOGIN, [
            'email' => 'jean@mail.com',
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_User_Admin_Can_Authenticate()
    {
        $response = $this->post(self::LOGIN, [
            'email' => 'jeancarlosrecio@hotmail.com',
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::ADMIN);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $this->post(self::LOGIN, [
            'email' => 'jeancarlosrecio@hotmail.com',
            'password' => '123456asdasdasd789',
        ]);

        $this->assertGuest();
    }
}
