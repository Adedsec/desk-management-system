<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_redirect_from_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_login_route()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_login_view_rendered()
    {
        $view = $this->view('auth.login');
        $view->assertSee('auth.login');
    }


    public function test_login_successful()
    {
        $username = 'test@tmail.com';
        $password = Hash::make('password');
        $remember_me = true;

        $user = User::create([
            'name' => 'test name',
            'email' => $username,
            'password' => $password,
            'phone_number' => '09363049766'
        ]);

        $response = $this->post('/login', [
            'email' => $username,
            'password' => 'password',
            'remeber_me' => true
        ]);

        $this->assertAuthenticatedAs($user);
        $user->delete();
    }

    public function test_login_wrong_credentials()
    {
        $username = 'test@tmail.com';
        $password = Hash::make('password');
        $remember_me = true;

        $user = User::create([
            'name' => 'test name',
            'email' => $username,
            'password' => $password,
            'phone_number' => '09363049766'
        ]);

        $response = $this->post('/login', [
            'email' => $username,
            'password' => 'password1',
            'remeber_me' => $remember_me
        ]);
        $response->assertSessionHas('errors');
        $this->assertGuest();
        $user->delete();
    }
}
