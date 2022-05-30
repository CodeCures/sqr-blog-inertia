<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_regiser_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Blog')
                    ->clickLink('Register')
                    ->waitForRoute('register')
                    ->assertRouteIs('register')
                    ->assertSee("Register")
                    ->type('name', 'Taylor Otwell')
                    ->type('email', 'taylor@laravel.com')
                    ->type('password', 'pass123')
                    ->type('password_confirmation', 'pass123')
                    ->press('Register')
                    ->assertRouteIs('dashboard')
                    ->assertSee('Dashboard')
                    ->clickLink('Logout')
                    ->assertPathIs('/');
        });
    }

    /** @test */
    public function can_login_correctly()
    {
        $user = User::factory()->create([
            'email' => 'taylor@laravel.com',
            'password' => 'pass123'
        ]);
        
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                    ->assertSee('Blog')
                    ->clickLink('Login')
                    ->assertRouteIs('login')
                    ->assertSee("Login")
                    ->type('email', $user->email)
                    ->type('password', 'pass123')
                    ->press('Login')
                    ->assertRouteIs('dashboard')
                    ->assertSee('Dashboard');
        });
    }

}
