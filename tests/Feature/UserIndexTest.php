<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserIndexTest extends TestCase
{
    use RefreshDatabase;

    public function boot()
    {
        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            $this->artisan('db:seed');
        });
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * @test
     */
    public function authenticatedUserCanListUsers()
    {
//      $user=new user();
        $user = DB::table('users')
            ->where('email', '=', 'jeancarlosrecio@hotmail.com')
            ->get();

        $this->post('/login', [
            'email' => 'jeancarlosrecio@hotmail.com',
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();
        $response = $this->get(route('admin.index'));
        $response->assertOk();
        $response->assertViewIs('admin.admin');

        $responseUsers = $response->getOriginalContent()['users'];

        $userdata = [];
        foreach ($user as $userArray) {
            $userdata = $userArray;
        }
        $responseUsers->each(function ($item) use ($user, $userdata) {
            $item->id == $userdata->id ? $this->assertEquals($userdata->id, $item->id) : null;
        });
    }

    /**
     * @test
     */
    public function anUserNotAuthenticatedNotCanListUsers()
    {
//
        $response = $this->get(route('admin.index'));

        $response->assertRedirect('login');
    }
}
