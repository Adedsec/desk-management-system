<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserSignupTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_signup_route()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_signup_view_rendered()
    {
        $view = $this->view('auth.register');
        $view->assertSee('auth.register');
    }

    public function test_signup_successful_without_avatar()
    {
        $name = 'test name';
        $email = 'test@email.com';
        $password = 'testpassword';
        $phone_number = '09363049766';
        $response = $this->post(route('register'), [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'phone_number' => $phone_number
        ]);

        $this->assertAuthenticatedAs(User::where('email', $email)->first());
        $response->assertRedirect(route('home'));

        User::where('email', $email)->first()->delete();
    }

}
